<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class CardCenterFactory extends Factory
{
    public function definition(): array
    {
        return [
            'number' => rand(1000000000000000, 9999999999999999),
            'expiry_month' => rand(1, 12),
            'expiry_year' => rand(2020, 2220),
            'csv' => Hash::make(001),               //csv 001
            'name' => $this->faker->name,
            'balance' => rand(0, 999999),
        ];
    }
}
