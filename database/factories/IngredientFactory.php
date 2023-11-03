<?php

namespace Database\Factories;

use FakerRestaurant\Provider\en_US\Restaurant;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        fake()->addProvider(new Restaurant($this->faker));

        return [
            'name' => $this->fakeIngredient()
        ];
    }

    private function fakeIngredient() {
        return Arr::random([
            fake()->vegetableName(),
            fake()->fruitName(),
            fake()->meatName(),
            fake()->sauceName(),
            fake()->dairyName()
        ]);
    }
}
