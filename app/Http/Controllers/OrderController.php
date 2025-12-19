<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function show(Order $order)
    {
        $order->load('items.toppings');
        return view('order-show', compact('order'));
    }
}
