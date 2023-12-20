<?php

namespace App\Mail;

use App\Models\ConversationMessage;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmission extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $message;

    /**
     * Create a new message instance.
     *
     * @param string $name
     * @param string $email
     * @param string $messa
     */
    public function __construct(string $name, string $email, string $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = '🚴‍ Contact Form submitted by ' . $this->name . ' on ' . config('app.name');

        return $this->subject($subject)
            ->replyTo($this->email)
            ->markdown('emails.contact-form');
    }
}
