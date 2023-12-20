<?php

namespace Database\Seeders;

use App\Models\Category;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->create(
            [
                'id' => 1,
                'name' => 'Mountain Bike',
            ]
        );

        Category::factory()->create(
            [
                'id' => 2,
                'name' => 'Road',
            ]
        );

        Category::factory()->create(
            [
                'id' => 3,
                'name' => 'Other',
            ]
        );

    }
}
