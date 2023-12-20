<?php

namespace App\Mail;

use App\Models\Bike;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExpirationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $bike;

    /**
     * Create a new message instance.
     *
     * @param Bike $bike
     */
    public function __construct(Bike $bike)
    {
        $this->bike = $bike;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = '⚠️ One of your ' . config('app.name') . ' listings have expired';

        return $this->subject($subject)
            ->markdown('emails.bikes.expiration-notification');
    }
}
