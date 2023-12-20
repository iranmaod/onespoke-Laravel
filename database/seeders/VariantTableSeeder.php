<?php

use Illuminate\Database\Seeder;

class VariantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    App\Variant::create([
        'name' =>'Colour',
     ]);
    
    App\Variant::create([
        'name' =>'Size',
     ]);
    
    App\Variant::create([
        'name' =>'Condition',
     ]);
    }
}
