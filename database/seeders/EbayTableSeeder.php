<?php

use Illuminate\Database\Seeder;

class EbayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {  App\CrawlerEbay::create([
        'affiliate_id' =>'',
          ]);
    }
}
