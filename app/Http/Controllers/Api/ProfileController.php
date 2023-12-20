<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreBikeRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function croppedAvatar(Request $request) {
        $request->validate([
           'profile_photo' => 'required|string',
       ]);

        $base64Image = $request->input('profile_photo');
        list($baseType, $image) = explode(';', $base64Image);
        list(, $image) = explode(',', $image);
        $image = base64_decode($image);
        $extension = 'png';

        $filename = md5(uniqid('', true) . microtime()) . '.' . $extension;

        Storage::disk()->put(sprintf("profile-images/%s/%s", $request->user()->getRouteKey(), $filename), $image, 'public');

        $request->user()->profileImages()->create(
            [
                'original_filename' => 'profile-picture' . '.' . $extension,
                'filename' => $filename,
            ]
        );

        return new UserResource($request->user());
    }

    public function avatar(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|max:10000|dimensions:max_width=6000,max_height=4000',
       ]);

        if ($request->has('profile_photo')) {

            $file = $request->file('profile_photo');

            $filename = md5($file->getClientOriginalName() . microtime()) . '.' . $file->extension();

            $file->storePubliclyAs('profile-images', sprintf("%s/%s", $request->user()->getRouteKey(), $filename));

            $request->user()->profileImages()->create(
                [
                    'original_filename' => $file->getClientOriginalName(),
                    'filename' => $filename,
                ]
            );

            return new UserResource($request->user());
        }
    }

    public function croppedBanner(Request $request) {

        $request->validate([
            'banner_image' => 'required|string',
        ]);

        $base64Image = $request->input('banner_image');
        list($baseType, $image) = explode(';', $base64Image);
        list(, $image) = explode(',', $image);
        $image = base64_decode($image);
        $extension = 'png';

        $filename = md5(uniqid('', true) . microtime()) . '.' . $extension;

        Storage::disk()->put(sprintf("banner-images/%s/%s", $request->user()->getRouteKey(), $filename), $image, 'public');

        $request->user()->bannerImages()->create(
            [
                'original_filename' => 'banner' . '.' . $extension,
                'filename' => $filename,
            ]
        );

        return new UserResource($request->user());
    }

    public function banner(Request $request)
    {
        $request->validate([
            'banner_image' => 'required|image|max:10000|dimensions:max_width=6000,max_height=4000',
        ]);

        if ($request->has('banner_image')) {

            $file = $request->file('banner_image');

            $filename = md5($file->getClientOriginalName() . microtime()) . '.' . $file->extension();

            $file->storePubliclyAs('banner-images', sprintf("%s/%s", $request->user()->getRouteKey(), $filename));

            $request->user()->bannerImages()->create(
                [
                    'original_filename' => $file->getClientOriginalName(),
                    'filename' => $filename,
                ]
            );

            return new UserResource($request->user());
        }
    }

    public function update(UpdateProfileRequest $request)
    {
        //dd('asdf');
        $validated = $request->validated();

        $request->user()->update($validated);

        if ($request->has('profile_photo')) {

            $file = $request->file('profile_photo');

            $filename = md5($file->getClientOriginalName() . microtime()) . '.' . $file->extension();

            $file->storePubliclyAs('profile-images', sprintf("%s/%s", $request->user()->getRouteKey(), $filename));

            $request->user()->profileImages()->create(
                [
                    'original_filename' => $file->getClientOriginalName(),
                    'filename' => $filename,
                ]
            );

        }

        if ($request->has('verification_images') && count($request->file('verification_images')) > 0) {

            foreach ($request->file('verification_images') as $file) {
                $filename = md5($file->getClientOriginalName() . microtime()) . '.' . $file->extension();

                $file->storePubliclyAs('verification-images', sprintf("%s/%s", $request->user()->getRouteKey(), $filename));

                $request->user()->verificationImages()->create(
                    [
                        'original_filename' => $file->getClientOriginalName(),
                        'filename' => $filename,
                    ]
                );
            }
        }

        return new UserResource($request->user());
    }
}
