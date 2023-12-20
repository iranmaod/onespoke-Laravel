<?php

namespace App\Jobs;

use App\Mail\ExpirationNotification;
use App\Mail\MessageReceived;
use App\Models\Bike;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

class BikeExpirationNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $bike;

    /**
     * Create a new job instance.
     *
     * @param Bike $bike
     */
    public function __construct(Bike $bike)
    {
        $this->bike = $bike;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->bike->user)->send(new ExpirationNotification($this->bike));
    }
}
