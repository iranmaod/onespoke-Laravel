<?php

namespace Database\Seeders;

use App\Models\Gender;

use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gender::factory()->create(
            [
                'name' => 'Unisex',
            ]
        );

        Gender::factory()->create(
            [
                'name' => 'Mens',
            ]
        );

        Gender::factory()->create(
            [
                'name' => 'Womens Specific',
            ]
        );

        Gender::factory()->create(
            [
                'name' => 'Kids',
            ]
        );

        Gender::factory()->create(
            [
                'name' => 'Kids (Boy\'s)',
            ]
        );

        Gender::factory()->create(
            [
                'name' => 'Kids (Girl\'s)',
            ]
        );

    }
}
