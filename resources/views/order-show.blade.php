<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Order #{{ $order->id }}</title>
  <style>
    body{font-family:Arial;max-width:980px;margin:24px auto;padding:0 12px}
    table{width:100%;border-collapse:collapse}
    th,td{border-bottom:1px solid #eee;padding:10px;text-align:left;vertical-align:top}
    .ok{background:#e6ffed;padding:10px;border-radius:8px;margin:10px 0}
  </style>
</head>
<body>
  <h1>🧾 Order #{{ $order->id }}</h1>

  @if(session('success'))
    <div class="ok">{{ session('success') }}</div>
  @endif

  <p><strong>Status:</strong> {{ $order->status }}</p>
  <p><strong>Payment:</strong> {{ strtoupper($order->payment_method) }}</p>
  <p><strong>Total:</strong> {{ $order->currency }} {{ number_format($order->total_minor/100, 2) }}</p>

  <h3>Items</h3>
  <table>
    <thead>
      <tr>
        <th>Item</th>
        <th>Qty</th>
        <th>Unit</th>
        <th>Line</th>
      </tr>
    </thead>
    <tbody>
      @foreach($order->items as $it)
        <tr>
          <td>
            <strong>{{ $it->name_snapshot }}</strong>
            @if($it->toppings->count())
              <div style="margin-top:6px;font-size:0.92em;">
                Toppings:
                <ul style="margin:6px 0 0 18px;">
                  @foreach($it->toppings as $t)
                    <li>{{ $t->topping_name_snapshot }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
          </td>
          <td>{{ $it->qty }}</td>
          <td>{{ number_format($it->unit_price_minor/100, 2) }}</td>
          <td><strong>{{ number_format($it->line_total_minor/100, 2) }}</strong></td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <p style="margin-top:14px;">
    ✅ Payment log saved to <code>storage/logs/payments.log</code>
  </p>

  <p><a href="{{ route('menu') }}">Order again</a></p>
</body>
</html>
