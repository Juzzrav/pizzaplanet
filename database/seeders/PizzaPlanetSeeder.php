<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pizza;
use App\Models\Topping;

class PizzaPlanetSeeder extends Seeder
{
    public function run(): void
    {
        // Toppings (default £1 each)
        $toppings = [
            'ham' => 'Ham',
            'olives' => 'Olives',
            'mushrooms' => 'Mushrooms',
            'bacon' => 'Bacon',
            'mince' => 'Mince',
            'pepperoni' => 'Pepperoni',
            'spicy_mince' => 'Spicy Mince',
            'onion' => 'Onion',
            'green_pepper' => 'Green Pepper',
            'jalapenos' => 'Jalapenos',
        ];

        foreach ($toppings as $code => $name) {
            Topping::updateOrCreate(
                ['code' => $code],
                ['name' => $name, 'price_minor' => 100, 'currency' => 'GBP']
            );
        }

        Pizza::updateOrCreate(
            ['code' => 'margherita'],
            ['name' => 'Margherita', 'base_price_minor' => 1000, 'currency' => 'GBP', 'is_customizable' => false]
        );

        Pizza::updateOrCreate(
            ['code' => 'romana'],
            ['name' => 'Romana', 'base_price_minor' => 1300, 'currency' => 'GBP', 'is_customizable' => false]
        );

        // Americana is $13
        Pizza::updateOrCreate(
            ['code' => 'americana'],
            ['name' => 'Americana', 'base_price_minor' => 1300, 'currency' => 'USD', 'is_customizable' => false]
        );

        Pizza::updateOrCreate(
            ['code' => 'mexicana'],
            ['name' => 'Mexicana', 'base_price_minor' => 1500, 'currency' => 'GBP', 'is_customizable' => false]
        );

        // Make your own: £10 base, toppings calculated at checkout/cart
        Pizza::updateOrCreate(
            ['code' => 'custom'],
            ['name' => 'Make your own', 'base_price_minor' => 1000, 'currency' => 'GBP', 'is_customizable' => true]
        );
    }
}
