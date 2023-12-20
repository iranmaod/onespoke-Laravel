<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;

use App\Models\Bike;
use Illuminate\Http\Request;

class BikeController extends Controller
{
    public function show(Request $request, Bike $bike, $slug = null)
    {
        $bike->addView($request->user());

        return view('website.bikes.show')->with(['bike' => $bike]);
    }

    public function edit(Request $request, Bike $bike, $slug = null)
    {
        return view('website.bikes.edit')->with(['bike' => $bike]);
    }
}
