<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function __invoke()
    {
        return view('website.privacy-policy');
    }
}
