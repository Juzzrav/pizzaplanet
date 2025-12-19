<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemTopping;
use App\Payments\PaymentGatewayResolver;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    private function getCart(): array
    {
        return session()->get('cart', []);
    }

    public function show()
    {
        $cart = $this->getCart();
        $items = $cart['items'] ?? [];
        $currency = $cart['currency'] ?? null;

        $subtotalMinor = 0;
        foreach ($items as $it) $subtotalMinor += (int) $it['line_total_minor'];

        if (empty($items)) {
            return redirect()->route('menu')->withErrors(['cart' => 'Your cart is empty.']);
        }

        return view('checkout', compact('items','currency','subtotalMinor'));
    }

    public function process(CheckoutRequest $request)
    {
        $cart = $this->getCart();
        $items = $cart['items'] ?? [];
        $currency = $cart['currency'] ?? null;

        if (empty($items) || !$currency) {
            return redirect()->route('menu')->withErrors(['cart' => 'Your cart is empty.']);
        }

        $subtotalMinor = 0;
        foreach ($items as $it) $subtotalMinor += (int) $it['line_total_minor'];

        $paymentMethod = $request->payment_method;

        $order = DB::transaction(function () use ($items, $currency, $subtotalMinor, $paymentMethod) {
            $order = Order::create([
                'status' => 'pending',
                'currency' => $currency,
                'total_minor' => $subtotalMinor,
                'payment_method' => $paymentMethod,
            ]);

            foreach ($items as $it) {
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'pizza_id' => $it['pizza_id'] ?? null,
                    'type' => $it['type'],
                    'name_snapshot' => $it['name'],
                    'unit_price_minor' => (int) $it['unit_price_minor'],
                    'qty' => (int) $it['qty'],
                    'line_total_minor' => (int) $it['line_total_minor'],
                ]);

                foreach (($it['toppings'] ?? []) as $t) {
                    OrderItemTopping::create([
                        'order_item_id' => $orderItem->id,
                        'topping_id' => $t['id'] ?? null,
                        'topping_name_snapshot' => $t['name'],
                        'topping_price_minor' => (int) $t['price_minor'],
                    ]);
                }
            }

            return $order;
        });

        // ✅ Strategy Pattern: resolve gateway then charge (mock log)
        (new PaymentGatewayResolver())->resolve($paymentMethod)->charge($order);

        // mark paid
        $order->update(['status' => 'paid']);

        // clear cart
        session()->forget('cart');

        return redirect()->route('orders.show', $order)->with('success', 'Order placed successfully!');
    }
}
