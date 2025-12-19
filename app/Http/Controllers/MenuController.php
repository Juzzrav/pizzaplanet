<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\Topping;

class MenuController extends Controller
{
    public function index()
    {
        $pizzas = Pizza::orderBy('id')->get();
        $toppings = Topping::orderBy('name')->get();

        return view('menu', compact('pizzas', 'toppings'));
    }
}
