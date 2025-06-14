<?php

namespace Database\Factories;

use App\Models\Recipe;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeFactory extends Factory
{
    protected $model = Recipe::class;

    public function definition(): array
    {
        return [
            'Name' => $this->faker->sentence(3),
            'Description' => $this->faker->paragraph(3),
            'Ingredients' => $this->faker->paragraph(2),
            'restaurant_id' => Restaurant::factory(),
            'premium' => $this->faker->boolean(30),
            'category' => $this->faker->randomElement(['Main Dish', 'Dessert', 'Beverage', 'Appetizer']),
            'image' => 'default.jpg',
        ];
    }
}
