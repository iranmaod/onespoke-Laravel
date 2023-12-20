<?php

use Illuminate\Database\Seeder;

class AliexpressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\CrawlerAliexpress::create([
        'affiliate_id' =>'',
          ]);
    }
}
