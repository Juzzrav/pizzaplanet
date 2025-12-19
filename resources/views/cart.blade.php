<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Cart</title>
  <style>
    body{font-family:Arial;max-width:980px;margin:24px auto;padding:0 12px}
    table{width:100%;border-collapse:collapse}
    th,td{border-bottom:1px solid #eee;padding:10px;text-align:left;vertical-align:top}
    .row{display:flex;justify-content:space-between;gap:12px;align-items:center}
    .btn{padding:10px 12px;border:0;border-radius:8px;cursor:pointer}
    .btn-danger{background:#c62828;color:#fff}
    .btn-link{background:transparent;border:1px solid #111}
    .ok{background:#e6ffed;padding:10px;border-radius:8px;margin:10px 0}
  </style>
</head>
<body>
  <div class="row">
    <h1>🛒 Cart</h1>
    <a href="{{ route('menu') }}">Back to menu</a>
  </div>

  @if(session('success'))
    <div class="ok">{{ session('success') }}</div>
  @endif

  @if(empty($items))
    <p>Your cart is empty.</p>
    <form method="POST" action="{{ route('cart.clear') }}">
      @csrf
      <button class="btn btn-link" type="submit">Reset Cart</button>
    </form>
    </body></html>
    @php exit; @endphp
  @endif

  <p><strong>Currency:</strong> {{ $currency }}</p>

  <table>
    <thead>
      <tr>
        <th>Item</th>
        <th>Qty</th>
        <th>Unit</th>
        <th>Total</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($items as $it)
        <tr>
          <td>
            <strong>{{ $it['name'] }}</strong>
            @if(!empty($it['toppings']))
              <div style="margin-top:6px;font-size:0.92em;">
                Toppings:
                <ul style="margin:6px 0 0 18px;">
                  @foreach($it['toppings'] as $t)
                    <li>{{ $t['name'] }} ({{ number_format($t['price_minor']/100,2) }})</li>
                  @endforeach
                </ul>
              </div>
            @endif
          </td>
          <td>{{ $it['qty'] }}</td>
          <td>{{ number_format($it['unit_price_minor']/100,2) }}</td>
          <td><strong>{{ number_format($it['line_total_minor']/100,2) }}</strong></td>
          <td>
            <form method="POST" action="{{ route('cart.remove', $it['key']) }}">
              @csrf
              <button class="btn btn-danger" type="submit">Remove</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div class="row" style="margin-top:14px;">
    <form method="POST" action="{{ route('cart.clear') }}">
      @csrf
      <button class="btn btn-link" type="submit">Clear cart</button>
    </form>

    <h2>Subtotal: {{ $currency }} {{ number_format($subtotalMinor/100, 2) }}</h2>
  </div>

  <p style="margin-top:14px;">
    Next: gagawin natin checkout + payment mock.
  </p>
</body>
</html>
