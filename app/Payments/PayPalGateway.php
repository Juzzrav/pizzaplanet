<?php

namespace App\Payments;

use App\Models\Order;
use Illuminate\Support\Facades\Log;

class PayPalGateway implements PaymentGateway
{
    public function charge(Order $order): void
    {
        Log::channel('payments')->info('MOCK PAYMENT: PAYPAL', [
            'order_id' => $order->id,
            'currency' => $order->currency,
            'total'    => $order->total_minor,
        ]);
    }
}
