<?php

namespace Database\Factories;

use App\Models\FrameSize;
use Illuminate\Database\Eloquent\Factories\Factory;

class FrameSizeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FrameSize::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->bothify('??????'),
        ];
    }
}
