<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->realText(10),
            'description' => $this->faker->realText(rand(10, 30)),
            'price' => $this->faker->numberBetween(1, 50),
            'quantity_on_hand' => $this->faker->numberBetween(1, 10)
        ];
    }
}
