<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\Hashidable;

class Conversation extends Model
{
    use HasFactory, SoftDeletes, Hashidable;

    protected $guarded = ['id'];

    public function participants()
    {
        return $this->hasMany(ConversationParticipant::class);
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, ConversationParticipant::class, 'conversation_id', 'id', 'id', 'user_id');
    }

    public function messages()
    {
        // This is returning duplicates, so add ->distinct() for now
        return $this->hasManyThrough(ConversationMessage::class, ConversationParticipant::class, 'conversation_id', 'conversation_id', 'id', 'conversation_id')->distinct()->oldest();
    }

    public function latestMessage()
    {
        return $this->hasOneThrough(ConversationMessage::class, ConversationParticipant::class, 'conversation_id', 'conversation_id', 'id', 'conversation_id')->latest();
    }

    public function markAsRead()
    {
        $this->messages()->update(['read' => 1]);
    }

}
