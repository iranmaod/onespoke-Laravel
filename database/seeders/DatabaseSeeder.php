<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ManufacturerSeeder::class,
            ConditionSeeder::class,
            SizeSeeder::class,
            WheelSizeSeeder::class,
            CategorySeeder::class,
            TypeSeeder::class,
            GenderSeeder::class,
        ]);
    }
}
