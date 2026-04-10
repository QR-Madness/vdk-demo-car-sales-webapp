<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'make' => fake()->randomElement(['Toyota', 'Honda', 'Ford', 'BMW', 'Mercedes', 'Audi', 'Tesla', 'Lexus']),
            'model' => fake()->word(),
            'year' => fake()->numberBetween(2015, 2024),
            'price' => fake()->numberBetween(10000, 80000),
            'mileage' => fake()->optional()->numberBetween(0, 100000),
            'color' => fake()->optional()->safeColorName(),
            'horsepower' => fake()->optional()->numberBetween(100, 500),
            'transmission' => fake()->optional()->randomElement(['Automatic', 'Manual', 'CVT']),
            'fuel_type' => fake()->optional()->randomElement(['Gasoline', 'Diesel', 'Electric', 'Hybrid']),
            'condition' => fake()->optional()->randomElement(['New', 'Excellent', 'Good', 'Fair', 'Poor']),
            'image' => null,
        ];
    }
}
