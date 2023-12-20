<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function __invoke(User $user)
    {
        $user->load('publishedOrSoldBikes');

        return view('website.user.profile')->with(['user' => $user]);
    }
}
