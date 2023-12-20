<?php

namespace App\Mail;

use App\Models\ConversationMessage;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $message;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param ConversationMessage $message
     */
    public function __construct(User $user, ConversationMessage $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = '🚴‍ New Message from ' . $this->message->user->displayName . ' on ' . config('app.name');

        return $this->subject($subject)
            ->markdown('emails.messages.received');
    }
}
