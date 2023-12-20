<?php

namespace Database\Seeders;

use App\Models\FrameSize;

use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        FrameSize::factory()->create(
            [
                'name' => 'Extra Small',
            ]
        );

        FrameSize::factory()->create(
            [
                'name' => 'Small',
            ]
        );

        FrameSize::factory()->create(
            [
                'name' => 'Medium',
            ]
        );

        FrameSize::factory()->create(
            [
                'name' => 'Medium/Large',
            ]
        );

        FrameSize::factory()->create(
            [
                'name' => 'Large',
            ]
        );

        FrameSize::factory()->create(
            [
                'name' => 'Extra Large',
            ]
        );

        FrameSize::factory()->create(
            [
                'name' => 'Extra Extra Large',
            ]
        );
    }
}
