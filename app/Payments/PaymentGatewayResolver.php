<?php

namespace App\Payments;

use InvalidArgumentException;

class PaymentGatewayResolver
{
    public function resolve(string $method): PaymentGateway
    {
        return match ($method) {
            'card'   => new CardGateway(),
            'paypal' => new PayPalGateway(),
            default  => throw new InvalidArgumentException("Unsupported payment method: {$method}"),
        };
    }
}
