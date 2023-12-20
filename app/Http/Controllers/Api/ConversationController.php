<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Http\Resources\ConversationCollection;
use App\Http\Resources\ConversationResource;
use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{

    public function index(Request $request)
    {
        return new ConversationCollection($request->user()->conversations);
    }

    public function show(Request $request, Conversation $conversation)
    {
        $conversation->markAsRead();
        return new ConversationResource($conversation);
    }

}
