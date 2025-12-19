<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Models\Pizza;
use App\Models\Topping;
use Illuminate\Support\Str;

class CartController extends Controller
{
    private function getCart(): array
    {
        return session()->get('cart', []);
    }

    private function setCart(array $cart): void
    {
        session()->put('cart', $cart);
    }

    private function cartCurrency(?array $cart = null): ?string
    {
        $cart ??= $this->getCart();
        return $cart['currency'] ?? null;
    }

    public function add(AddToCartRequest $request)
    {
        $pizza = Pizza::where('code', $request->pizza_code)->firstOrFail();
        $qty = (int) $request->qty;

        $toppingIds = $request->input('toppings', []);
        if ($pizza->code !== 'custom') {
            $toppingIds = []; // fixed pizzas ignore toppings input
        }

        if (count($toppingIds) > 4) {
            return back()->withErrors(['toppings' => 'Max 4 toppings only.'])->withInput();
        }

        $cart = $this->getCart();

        // ✅ Currency guard: one currency per cart
        $cartCurrency = $cart['currency'] ?? null;
        if ($cartCurrency && $cartCurrency !== $pizza->currency) {
            return back()->withErrors([
                'currency' => "Currency mismatch. Your cart is {$cartCurrency}. This pizza is {$pizza->currency}. Please clear cart first."
            ])->withInput();
        }

        $cart['currency'] = $cartCurrency ?? $pizza->currency;

        $toppings = [];
        $toppingsTotalMinor = 0;

        if ($pizza->code === 'custom') {
            $toppings = Topping::whereIn('id', $toppingIds)->get()->map(function ($t) {
                return [
                    'id' => $t->id,
                    'name' => $t->name,
                    'price_minor' => (int) $t->price_minor,
                ];
            })->values()->all();

            // make-your-own topping price: £1 each (we seeded 100 minor)
            foreach ($toppings as $t) {
                $toppingsTotalMinor += (int) $t['price_minor'];
            }
        }

        $unitMinor = (int) $pizza->base_price_minor + $toppingsTotalMinor;
        $lineMinor = $unitMinor * $qty;

        $key = (string) Str::uuid();

        $cart['items'][$key] = [
            'key' => $key,
            'pizza_id' => $pizza->id,
            'pizza_code' => $pizza->code,
            'name' => $pizza->name,
            'type' => $pizza->code === 'custom' ? 'custom' : 'fixed',
            'qty' => $qty,
            'unit_price_minor' => $unitMinor,
            'line_total_minor' => $lineMinor,
            'toppings' => $toppings,
        ];

        $this->setCart($cart);

        return redirect()->route('cart.show')->with('success', 'Added to cart!');
    }

    public function show()
    {
        $cart = $this->getCart();
        $items = $cart['items'] ?? [];
        $currency = $cart['currency'] ?? null;

        $subtotalMinor = 0;
        foreach ($items as $it) {
            $subtotalMinor += (int) $it['line_total_minor'];
        }

        return view('cart', [
            'items' => $items,
            'currency' => $currency,
            'subtotalMinor' => $subtotalMinor,
        ]);
    }

    public function remove(string $key)
    {
        $cart = $this->getCart();
        if (isset($cart['items'][$key])) {
            unset($cart['items'][$key]);
        }

        if (empty($cart['items'])) {
            unset($cart['currency']);
        }

        $this->setCart($cart);

        return redirect()->route('cart.show')->with('success', 'Item removed.');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('menu')->with('success', 'Cart cleared.');
    }
}
