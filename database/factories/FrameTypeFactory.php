<?php

namespace Database\Factories;

use App\Models\FrameType;
use Illuminate\Database\Eloquent\Factories\Factory;

class FrameTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FrameType::class;

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
