<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'status','currency','total_minor','payment_method'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
