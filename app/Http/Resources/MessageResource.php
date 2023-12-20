<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class MessageResource extends JsonResource
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
            'user' => new MessageUserResource($this->user),
            'message' => $this->message,
            'message_preview' => Str::limit($this->message, 50, '...'),
            'created_at' => $this->created_at,
            'sent_at' => $this->created_at->format('d/m/Y H:i'),
            'read' => $this->read,
        ];
    }
}
