<?php

namespace App\Console\Commands;

use App\Models\Bike;
use Illuminate\Console\Command;

class ExpireListings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire-listings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find listings that have been published for 30 days or more and unpublish them';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Bike::expireListings();

        return 0;
    }
}
