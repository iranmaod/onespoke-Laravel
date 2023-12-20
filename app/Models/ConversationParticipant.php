<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConversationParticipant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'conversation_id',
        'message_id',
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

}
