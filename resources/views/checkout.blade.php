<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Checkout</title>
  <style>
    body{font-family:Arial;max-width:980px;margin:24px auto;padding:0 12px}
    .card{border:1px solid #ddd;border-radius:10px;padding:14px}
    .row{display:flex;justify-content:space-between;align-items:center;gap:12px}
    .btn{padding:10px 12px;border:0;border-radius:8px;cursor:pointer}
    .btn-primary{background:#111;color:#fff}
    .err{background:#ffe3e3;padding:10px;border-radius:8px;margin:10px 0}
  </style>
</head>
<body>
  <div class="row">
    <h1>✅ Checkout</h1>
    <a href="{{ route('cart.show') }}">Back to cart</a>
  </div>

  @if($errors->any())
    <div class="err">
      <ul>
        @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif

  <div class="card">
    <p><strong>Currency:</strong> {{ $currency }}</p>
    <p><strong>Total:</strong> {{ $currency }} {{ number_format($subtotalMinor/100, 2) }}</p>

    <form method="POST" action="{{ route('checkout.process') }}">
      @csrf

      <h3>Payment method</h3>
      <label><input type="radio" name="payment_method" value="card" checked> Card</label><br>
      <label><input type="radio" name="payment_method" value="paypal"> PayPal</label><br><br>

      <button class="btn btn-primary" type="submit">Place order</button>
    </form>
  </div>
</body>
</html>
