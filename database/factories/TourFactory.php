<?php

namespace Database\Factories;

use App\Models\Travel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tour>
 */
class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $travel_ids = Travel::pluck('id')->toArray();
        return [
            'name' => fake()->text(20),
            'starting_date' => fake()->date(),
            'ending_date' => fake()->date(),
            'travel_id' =>  $travel_ids[array_rand($travel_ids)],
            'price' => fake()->numberBetween(1500,15000)
        ];
    }
}
