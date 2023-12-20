<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Http\Resources\BikeCollection;
use App\Models\Bike;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{

    public function index(Request $request)
    {
        return new BikeCollection($request->user()->favouriteBikes);
    }

    public function favourite(Request $request, Bike $bike)
    {
        $bike->favouritedBy($request->user());

        return response()->json([
            'message' => 'Bike has been added to favourites',
        ]);
    }

    public function unfavourite(Request $request, Bike $bike)
    {
        $bike->unfavouritedBy($request->user());

        return response()->json([
            'message' => 'Bike has been removed from favourites',
        ]);
    }

}
