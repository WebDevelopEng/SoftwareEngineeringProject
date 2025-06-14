<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory
{
    protected $model = Restaurant::class;

    public function definition()
    {
        return [
            'restaurantEmail' => $this->faker->unique()->safeEmail,
            'password' => 'randompassword', // Not hashed
            'restaurantName' => $this->faker->company,
            'balance' => $this->faker->randomFloat(2, 100, 1000),
            'location' => $this->faker->address,
            'image' => 'default.jpg',
        ];
    }
}
