<?php

namespace Database\Factories;

use App\Models\Measurement;
use FakerRestaurant\Provider\en_US\Restaurant;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

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
            'name' => $this->fakeIngredient(),
            'qty' => fake()->randomFloat(1, 1, 10),
            'measurement_id' => DB::table('measurements')->inRandomOrder()->first()->id
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
