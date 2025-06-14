<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    public function definition(): array
    {
        $startDate = Carbon::now();
        $endDate = $startDate->copy()->addMonths($this->faker->numberBetween(1, 12));

        return [
            'memberId' => User::factory(),
            'price' => $this->faker->randomFloat(2, 50, 500),
            'activeStatus' => $this->faker->boolean(),
            'membershipStart' => $startDate->format('Y-m-d'),
            'membershipDueDate' => $endDate->format('Y-m-d'),
        ];
    }
}
