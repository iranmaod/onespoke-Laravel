<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Http\Requests\ContactFormRequest;
use App\Jobs\ContactFormNotification;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    public function send(ContactFormRequest $request) {
        ContactFormNotification::dispatch($request->name, $request->email, $request->message);
    }

}
