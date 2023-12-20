<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\FrameType;

use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FrameType::factory()->create(
            [
                'name' => 'Cross Country',
                'category_id' => Category::MOUNTAIN_BIKE,
            ]
        );

        FrameType::factory()->create(
            [
                'name' => 'Dirtjump',
                'category_id' => Category::MOUNTAIN_BIKE,
            ]
        );

        FrameType::factory()->create(
            [
                'name' => 'Downhill',
                'category_id' => Category::MOUNTAIN_BIKE,
            ]
        );

        FrameType::factory()->create(
            [
                'name' => 'Enduro',
                'category_id' => Category::MOUNTAIN_BIKE,
            ]
        );

        FrameType::factory()->create(
            [
                'name' => 'Fat Bike',
                'category_id' => Category::MOUNTAIN_BIKE,
            ]
        );

        FrameType::factory()->create(
            [
                'name' => 'Trail',
                'category_id' => Category::MOUNTAIN_BIKE,
            ]
        );

        FrameType::factory()->create(
            [
                'name' => 'BMX',
                'category_id' => Category::OTHER,
            ]
        );

        FrameType::factory()->create(
            [
                'name' => 'Childrens',
                'category_id' => Category::OTHER,
            ]
        );

        FrameType::factory()->create(
            [
                'name' => 'Electric',
                'category_id' => Category::OTHER,
            ]
        );

        FrameType::factory()->create(
            [
                'name' => 'Folding',
                'category_id' => Category::OTHER,
            ]
        );

        FrameType::factory()->create(
            [
                'name' => 'Tandem',
                'category_id' => Category::OTHER,
            ]
        );

        FrameType::factory()->create(
            [
                'name' => 'Penny Farthing',
                'category_id' => Category::OTHER,
            ]
        );

        FrameType::factory()->create(
            [
                'name' => 'Unicycle',
                'category_id' => Category::OTHER,
            ]
        );

        FrameType::factory()->create(
            [
                'name' => 'Cyclocross',
                'category_id' => Category::OTHER,
            ]
        );

        FrameType::factory()->create(
            [
                'name' => 'Hybrid / Commuter',
                'category_id' => Category::ROAD,
            ]
        );

        FrameType::factory()->create(
            [
                'name' => 'Road',
                'category_id' => Category::ROAD,
            ]
        );

        FrameType::factory()->create(
            [
                'name' => 'Touring',
                'category_id' => Category::ROAD,
            ]
        );

        FrameType::factory()->create(
            [
                'name' => 'Track',
                'category_id' => Category::ROAD,
            ]
        );

        FrameType::factory()->create(
            [
                'name' => 'Triathlon',
                'category_id' => Category::ROAD,
            ]
        );

        FrameType::factory()->create(
            [
                'name' => 'Gravel',
                'category_id' => Category::MOUNTAIN_BIKE,
            ]
        );

        FrameType::factory()->create(
            [
                'name' => 'Mountain Bike',
                'category_id' => Category::MOUNTAIN_BIKE,
            ]
        );

    }
}
