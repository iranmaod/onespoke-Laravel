<?php

namespace Database\Seeders;

use App\Models\WheelSize;

use Illuminate\Database\Seeder;

class WheelSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WheelSize::factory()->create(
            [
                'name' => '16"',
            ]
        );

        WheelSize::factory()->create(
            [
                'name' => '20"',
            ]
        );

        WheelSize::factory()->create(
            [
                'name' => '24"',
            ]
        );

        WheelSize::factory()->create(
            [
                'name' => '26"',
            ]
        );

        WheelSize::factory()->create(
            [
                'name' => '27.5"',
            ]
        );

        WheelSize::factory()->create(
            [
                'name' => '29"',
            ]
        );

        WheelSize::factory()->create(
            [
                'name' => '32"',
            ]
        );

    }
}
