<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Step;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->seedMeasurementUnits();

        Recipe::factory()
            ->count(200)
            ->has(Ingredient::factory()->count(5))
            ->has(Step::factory()->count(5))
            ->create();
    }

    /**
     * Seed all ingredient measurement units
     */
    private function seedMeasurementUnits()
    {
        DB::table('measurements')->insert([
            ['unit' => 'ounces'],
            ['unit' => 'cups'],
            ['unit' => 'grams'],
            ['unit' => 'pounds'],
            ['unit' => 'quarts'],
            ['unit' => 'liters'],
        ]);
    }
}
