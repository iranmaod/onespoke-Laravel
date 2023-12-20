<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __invoke()
    {
        return view('website.account.messages');
    }
}
