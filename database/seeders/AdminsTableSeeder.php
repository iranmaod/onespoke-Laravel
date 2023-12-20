<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\Admin::create([
      'name' =>'rootuser',
      'display_name' =>'Root',
      'email' =>'info@products.com.ng',
      'password' =>bcrypt('password')
    ]);
    }
}
