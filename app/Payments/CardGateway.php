<?php

namespace App\Payments;

use App\Models\Order;
use Illuminate\Support\Facades\Log;

class CardGateway implements PaymentGateway
{
    public function charge(Order $order): void
    {
        Log::channel('payments')->info('MOCK PAYMENT: CARD', [
            'order_id' => $order->id,
            'currency' => $order->currency,
            'total'    => $order->total_minor,
        ]);
    }
}
