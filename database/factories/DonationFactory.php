<?php

namespace Database\Factories;

use App\Models\Donation;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
{
    protected $model = Donation::class;

    public function definition()
    {
        return [
            'restaurant_id' => Restaurant::factory(),
            'name' => $this->faker->word . ' Donation',
            'price' => $this->faker->randomFloat(2, 5, 100),
            'description' => $this->faker->sentence(6),
            'image' => 'donation_sample.jpg',
            'count' => $this->faker->numberBetween(1, 50),
        ];
    }
}
