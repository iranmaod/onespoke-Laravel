<?php

namespace App\Http\Resources;

use App\Models\ConversationMessage;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getRouteKey(),
            'user' => new MessageUserResource($this->users()->where('users.id', '!=', $request->user()->id)->first()),
            'messages' => MessageResource::collection($this->messages),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'unread_count' => ConversationMessage::where('conversation_id', '=', $this->id)
                ->where('read', 0)
                ->where('user_id', '!=', $request->user()->id)
                ->count(),
        ];
    }
}
