<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Http\Resources\BikeCollection;
use App\Models\Bike;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class AlsoViewedController extends Controller
{

    public function index(Request $request, Bike $bike)
    {
        $alsoViewed = new BikeCollection($bike->alsoViewed());

        $favouriteListings = new Collection();

        if ($request->user()) {
            $favouriteListings = new BikeCollection($request->user()->favouriteBikes);
        }

        return [
            'also_viewed' => $alsoViewed,
            'favourite_listings' => $favouriteListings,
        ];
    }

}
