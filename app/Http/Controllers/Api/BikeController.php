<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Http\Requests\SearchBikeRequest;
use App\Http\Requests\StoreBikeRequest;
use App\Http\Requests\UpdateBikeRequest;
use App\Http\Resources\BikeCollection;
use App\Http\Resources\BikeResource;
use App\Models\Bike;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
use JustSteveKing\LaravelPostcodes\Facades\Postcode;

class BikeController extends Controller
{
    public function index(SearchBikeRequest $request) {

        $favouriteListings = new Collection();

        if ($request->user()) {
            $favouriteListings = new BikeCollection($request->user()->favouriteBikes);
        }

        $query = Bike::query();
        $query->select('bikes.*');

        $query->published();
        $query->unpaused();
        $query->unsold();

        $query->with('condition', 'manufacturer', 'frameType', 'frameSize', 'wheelSize', 'gender', 'images');

        $query->when(!empty($request->postcode), function ($q) use ($request) {

            if (!Postcode::validate($request->postcode)) {
                return $q;
            }

            $postcodeLookup = Postcode::getPostcode($request->postcode);

            $q->selectRaw('(ST_DISTANCE_SPHERE(point(longitude, latitude), point(?, ?)) * .000621371192) as distance', [
                $postcodeLookup->longitude,
                $postcodeLookup->latitude,
            ]);

            $q->whereRaw("
                   (ST_DISTANCE_SPHERE(
                        point(longitude, latitude),
                        point(?, ?)
                    ) * .000621371192) < ?
                ", [
                $postcodeLookup->longitude,
                $postcodeLookup->latitude,
                $request->distance,
            ]);

            $q->orderBy('distance', 'asc');
        });

        $query->when(!empty($request->search), function ($q) use ($request) {
            return $q->where('title', 'like', '%' . $request->search . '%');
        });

        $query->when(!empty($request->uploaded_to_veloeye), function ($q) use ($request) {
            return $q->where('uploaded_to_veloeye', '=', $request->uploaded_to_veloeye);
        });

        $query->when(!empty($request->min_price), function ($q) use ($request) {
            return $q->where('price', '>=', $request->min_price * 100);
        });

        $query->when(!empty($request->max_price), function ($q) use ($request) {
            return $q->where('price', '<=', $request->max_price * 100);
        });

        $query->when(!empty($request->conditions), function ($q) use ($request) {
            return $q->whereIn('condition_id', $request->conditions);
        });

        $query->when(!empty($request->manufacturers), function ($q) use ($request) {
            return $q->whereIn('manufacturer_id', $request->manufacturers);
        });

        $query->when(!empty($request->types), function ($q) use ($request) {
            return $q->whereIn('frame_type_id', $request->types);
        });

        $query->when(!empty($request->sizes), function ($q) use ($request) {
            return $q->whereIn('frame_size_id', $request->sizes);
        });

        $query->when(!empty($request->wheel_sizes), function ($q) use ($request) {
            return $q->whereIn('wheel_size_id', $request->wheel_sizes);
        });

        $query->when(!empty($request->genders), function ($q) use ($request) {
            return $q->whereIn('gender_id', $request->genders);
        });

        $query->when(!empty($request->order), function ($q) use ($request) {
            if ($request->order === 'price_low_to_high') {
                return $q->orderBy('price', 'asc');
            }

            if ($request->order === 'price_high_to_low') {
                return $q->orderBy('price', 'desc');
            }

            if ($request->order === 'newest') {
                return $q->orderBy('created_at', 'desc');
            }

            if ($request->order === 'newest') {
                return $q->orderBy('created_at', 'asc');
            }
        });


        $featuredListings = new BikeCollection($query->get());

        return [
            'featured_listings' => $featuredListings,
            'favourite_listings' => $favouriteListings,
        ];

    }

    public function store(StoreBikeRequest $request)
    {
        $validated = $request->validated();

        if (!empty($request->postcode)) {
            try {
                $postcodeLookup = Postcode::getOutwardCode($request->postcode);
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                throw ValidationException::withMessages(['postcode' => 'Please enter the FIRST part of a valid postcode']);
            }
        }

        $bike = $request->user()->bikes()->create($validated);

        if (isset($postcodeLookup->outcode)) {
            $bike->postcode = $postcodeLookup->outcode;
            $bike->latitude = $postcodeLookup->latitude;
            $bike->longitude = $postcodeLookup->longitude;
            $bike->district = $postcodeLookup->admin_district[0];
            $bike->country = $postcodeLookup->country[0];
        }

        if ($request->has('images') && count($request->file('images')) > 0) {

            $order = 0;

            foreach ($request->file('images') as $file) {
                $filename = md5($file->getClientOriginalName() . microtime()) . '.' . $file->extension();

                // original
                $file->storePubliclyAs('bike-images', sprintf("%s/%s", $bike->getRouteKey(), $filename));

                // thumb
                $image = Image::make($file);
                $image->orientate();
                $image->resize(720, 1280, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                Storage::disk('s3')->put(sprintf("bike-thumbs/%s/%s", $bike->getRouteKey(), $filename), $image->stream()->__toString(), 'public');

                $bike->images()->create(
                    [
                        'original_filename' => $file->getClientOriginalName(),
                        'filename' => $filename,
                        'order' => $order,
                    ]
                );

                $order++;
            }
        }

        $bike->publish();

        return new BikeResource($bike);
    }

    public function update(UpdateBikeRequest $request, Bike $bike)
    {
        $validated = $request->except(['postcode']);

        if (!empty($request->postcode)) {
            try {
                $postcodeLookup = Postcode::getOutwardCode($request->postcode);
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                throw ValidationException::withMessages(['postcode' => 'Please enter the FIRST part of a valid postcode']);
            }
        }

        $bike->update($validated);

        $bike->postcode = null;
        $bike->latitude = null;
        $bike->longitude = null;
        $bike->district = null;
        $bike->country = null;

        if (isset($postcodeLookup->outcode)) {
            $bike->postcode = $postcodeLookup->outcode;
            $bike->latitude = $postcodeLookup->latitude;
            $bike->longitude = $postcodeLookup->longitude;
            $bike->district = $postcodeLookup->admin_district[0];
            $bike->country = $postcodeLookup->country[0];
        }

        $bike->save();

        if ($request->has('images') && count($request->file('images')) > 0) {

            $order = $bike->images()->max('order') + 1;

            foreach ($request->file('images') as $file) {
                $filename = md5($file->getClientOriginalName() . microtime()) . '.' . $file->extension();

                // original
                $file->storePubliclyAs('bike-images', sprintf("%s/%s", $bike->getRouteKey(), $filename));

                // thumb
                $image = Image::make($file);
                $image->orientate();

                $image->resize(720, 1280, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                Storage::disk('s3')->put(sprintf("bike-thumbs/%s/%s", $bike->getRouteKey(), $filename), $image->stream()->__toString(), 'public');

                $bike->images()->create(
                    [
                        'original_filename' => $file->getClientOriginalName(),
                        'filename' => $filename,
                        'order' => $order,
                    ]
                );

                $order++;
            }
        }

        return new BikeResource($bike);
    }
}
