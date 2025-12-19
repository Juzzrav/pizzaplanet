<?php

namespace Database\Factories;

use App\Models\Pizza;
use Illuminate\Database\Eloquent\Factories\Factory;

class PizzaFactory extends Factory
{
    protected $model = Pizza::class;

    public function definition(): array
    {
        return [
            'code' => strtoupper($this->faker->bothify('PZ###')),
            'name' => $this->faker->words(2, true),
            'base_price_minor' => $this->faker->numberBetween(19900, 69900), // cents (e.g. 199.00)
            'currency' => 'PHP',
            'is_customizable' => $this->faker->boolean(),
        ];
    }
}
