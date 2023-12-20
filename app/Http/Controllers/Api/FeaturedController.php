<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Http\Resources\BikeCollection;
use App\Models\Bike;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class FeaturedController extends Controller
{

    public function index(Request $request)
    {
        $featuredListings = new BikeCollection(Bike::featuredBikes());

        $favouriteListings = new Collection();

        if ($request->user()) {
            $favouriteListings = new BikeCollection($request->user()->favouriteBikes);
        }

        return [
            'featured_listings' => $featuredListings,
            'favourite_listings' => $favouriteListings,
        ];
    }

}
