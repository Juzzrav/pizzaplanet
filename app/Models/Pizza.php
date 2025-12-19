<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
      use HasFactory;
    protected $fillable = [
        'code','name','base_price_minor','currency','is_customizable'
    ];
}
