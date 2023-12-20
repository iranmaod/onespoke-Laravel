<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Http\Resources\BikeCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class UserListingController extends Controller
{

    public function index(Request $request, User $user, $slug = null)
    {
        $featuredListings = new BikeCollection($user->bikes()->published()->unsold()->unpaused()->get());

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
