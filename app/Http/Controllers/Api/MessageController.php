<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Resources\BikeCollection;
use App\Jobs\MessageReceivedNotification;
use App\Models\Conversation;
use App\Models\ConversationMessage;
use App\Models\ConversationParticipant;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function unread(Request $request)
    {
        return $request->user()->unreadMessages();
    }

    public function store(StoreMessageRequest $request, User $user, $slug = null)
    {
        // check if there's an existing conversation between these two users
        $users = [$request->user(), $user];

        $conversationQuery = Conversation::withTrashed();

        foreach ($users as $u) {
            $conversationQuery->whereHas('participants', function ($query) use($u) {
                $query->where('conversation_participants.user_id', $u->id);
            });
        }

        $conversation = $conversationQuery->first();

        if (empty($conversation)) {
            $conversation = new Conversation();
            $conversation->save();

            foreach ($users as $u) {
                $conversationParticipant = new ConversationParticipant();
                $conversationParticipant->conversation_id = $conversation->id;
                $conversationParticipant->user_id = $u->id;
                $conversationParticipant->save();
            }
        }

        // create a new message in the conversation
        $message = new ConversationMessage();
        $message->conversation_id = $conversation->id;
        $message->user_id = $request->user()->id;
        $message->message = $request->message;

        $message->save();

        MessageReceivedNotification::dispatch($user, $message);

        return response()->json([
            'message' => 'Message has been sent to ' . $user->displayName,
        ]);

    }

}
