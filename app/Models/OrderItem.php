<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id','pizza_id','type','name_snapshot','unit_price_minor','qty','line_total_minor'
    ];

    public function toppings()
    {
        return $this->hasMany(OrderItemTopping::class);
    }
}
