<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use App\Models\Bike;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
       
        return view('website.home');
    }
}
