<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Http\Resources\BikeCollection;
use App\Models\Bike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ListingController extends Controller
{

    public function index(Request $request)
    {
        $activeListings = new BikeCollection($request->user()->bikes()->unsold()->get());
        $soldListings = new BikeCollection($request->user()->bikes()->sold()->get());

        return [
            'active_listings' => $activeListings,
            'sold_listings' => $soldListings,
        ];
    }

    public function sold(Request $request, Bike $bike)
    {

        if (! Gate::allows('update-bike', $bike)) {
            abort(403);
        }

        $bike->markAsSold();

        return response()->json([
            'message' => 'Bike has been marked as sold',
        ]);
    }

    public function publish(Request $request, Bike $bike)
    {
        if (! Gate::allows('update-bike', $bike)) {
            abort(403);
        }

        $bike->publish();

        return response()->json([
            'message' => 'Bike has been published',
        ]);
    }

    public function unpublish(Request $request, Bike $bike)
    {
        if (! Gate::allows('update-bike', $bike)) {
            abort(403);
        }

        $bike->unpublish();

        return response()->json([
            'message' => 'Bike has been unpublished',
        ]);
    }

    public function delete(Request $request, Bike $bike)
    {
        if (! Gate::allows('update-bike', $bike)) {
            abort(403);
        }

        $bike->delete();

        return response()->json([
            'message' => 'Bike has been deleted',
        ]);
    }

    public function pause(Request $request, Bike $bike)
    {
        if (! Gate::allows('update-bike', $bike)) {
            abort(403);
        }

        $bike->pause();

        return response()->json([
            'message' => 'Bike has been paused',
        ]);
    }

    public function unpause(Request $request, Bike $bike)
    {
        if (! Gate::allows('update-bike', $bike)) {
            abort(403);
        }

        $bike->unpause();

        return response()->json([
            'message' => 'Bike has been unpaused',
        ]);
    }
}
