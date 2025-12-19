<?php

namespace App\Payments;

use App\Models\Order;

interface PaymentGateway
{
    public function charge(Order $order): void;
}
