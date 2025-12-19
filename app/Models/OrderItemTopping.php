<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItemTopping extends Model
{
    protected $table = 'order_item_toppings';

    protected $fillable = [
        'order_item_id','topping_id','topping_name_snapshot','topping_price_minor'
    ];
}
