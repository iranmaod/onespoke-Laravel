<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\Models\Setting::create([
      'disqus'=>'https://comparison-1.disqus.com/embed.js',
      'currency_id' =>'147',
      'logo'=>'uploads/logo/logo.png',
      'site_name'=>'Qp Dropship',
      'site_email'=>'info@products.com.ng',
      'site_about'=>'Lorem ipsum dolor sit amet, anim id est laborum. Sed ut perspconsectetur, adipisci vam aliquam qua',
      'site_address'=>'Lorem ipsum dolor sit amet, anim id est laborum. Sed ut perspconsectetur, adipisci vam aliquam qua',
      'site_number'=>'+123456789',
      'live_production'=>'1',
      'csv_import_limit'=>'1000',
      'default_quantity'=>'2',
      'home_rand_pro'=>'8',
      'home_posts'=>'4',
      'home_users'=>'6',
      'cart_button'=>'Add to Cart',
      'delivery_terms'=>'<p><strong>Free Shipping Thresholds</strong>&nbsp;(Excluding International Customers):</p>
<p>- Over&nbsp;<strong>$250</strong>&nbsp;Free FedEx Ground or&nbsp;USPS Priority<br />- Over&nbsp;<strong>$800</strong>&nbsp;Free FedEx Standard Overnight<br />- Over&nbsp;<strong>$1000</strong>&nbsp;Free FedEx Priority Overnight</p>',

    ]);
    }
}
