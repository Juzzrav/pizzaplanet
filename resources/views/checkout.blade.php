<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>PizzaPlanet Checkout</title>
  <style>
    :root{
      --bg:#0b0f1a;
      --panel:#0f172a;
      --card:#111c35;
      --border:rgba(255,255,255,.10);
      --text:#e5e7eb;
      --muted:#a3a3a3;
      --brand:#f59e0b;
      --good:#22c55e;
      --bad:#ef4444;
      --shadow:0 18px 40px rgba(0,0,0,.35);
      --radius:16px;
    }
    *{box-sizing:border-box}
    body{
      margin:0;
      font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Apple Color Emoji","Segoe UI Emoji";
      color:var(--text);
      background:
        radial-gradient(900px 400px at 15% 0%, rgba(245,158,11,.22), transparent 60%),
        radial-gradient(800px 360px at 85% 20%, rgba(59,130,246,.18), transparent 60%),
        var(--bg);
    }
    a{color:inherit;text-decoration:none}
    code{background:rgba(255,255,255,.06);padding:2px 6px;border-radius:8px;border:1px solid var(--border)}
    .container{max-width:1100px;margin:0 auto;padding:22px 14px 42px}
    .topbar{
      display:flex;align-items:center;justify-content:space-between;gap:12px;
      padding:14px 16px;border:1px solid var(--border);
      background:rgba(15,23,42,.70); backdrop-filter: blur(10px);
      border-radius:var(--radius); box-shadow: var(--shadow);
      position:sticky; top:14px; z-index:10;
    }
    .brand{display:flex;align-items:center;gap:10px}
    .logo{
      width:38px;height:38px;border-radius:12px;
      background:linear-gradient(135deg, rgba(245,158,11,1), rgba(255,255,255,.12));
      display:grid;place-items:center;font-size:18px;
      box-shadow:0 10px 26px rgba(245,158,11,.18);
    }
    .brand h1{font-size:16px;margin:0;font-weight:800;letter-spacing:.2px}
    .brand p{margin:2px 0 0;font-size:12px;color:var(--muted)}
    .actions{display:flex;align-items:center;gap:10px;flex-wrap:wrap}
    .btn{
      border:0;cursor:pointer;border-radius:12px;
      padding:10px 12px;font-weight:800;
      display:inline-flex;align-items:center;justify-content:center;gap:8px;
      transition: transform .12s ease, opacity .12s ease, background .12s ease;
      user-select:none;
    }
    .btn:active{transform: translateY(1px)}
    .btn-primary{
      background:linear-gradient(135deg, rgba(245,158,11,1), rgba(251,191,36,1));
      color:#0b0f1a;
    }
    .btn-ghost{
      background:transparent;color:var(--text);
      border:1px solid var(--border);
    }
    .flash{
      margin-top:14px;
      padding:12px 14px;border-radius:14px;
      border:1px solid var(--border);
      background:rgba(17,28,53,.70);
    }
    .flash.err{border-color: rgba(239,68,68,.35); box-shadow:0 10px 24px rgba(239,68,68,.10)}
    .grid{
      margin-top:16px;
      display:grid;
      grid-template-columns: 1.2fr .8fr;
      gap:14px;
      align-items:start;
    }
    .card{
      border:1px solid var(--border);
      background:rgba(17,28,53,.62);
      border-radius:var(--radius);
      box-shadow: var(--shadow);
      overflow:hidden;
    }
    .card-head{
      padding:14px 16px;border-bottom:1px solid var(--border);
      background:rgba(15,23,42,.55);
      display:flex;justify-content:space-between;gap:10px;align-items:flex-start;
    }
    .card-head h2{margin:0;font-size:16px;font-weight:1000}
    .meta{color:var(--muted);font-size:12px;margin-top:6px}
    table{width:100%;border-collapse:collapse}
    th,td{padding:12px 16px;border-bottom:1px solid rgba(255,255,255,.06);vertical-align:top}
    th{font-size:12px;color:var(--muted);text-transform:uppercase;letter-spacing:.12em}
    .money{font-weight:1000}
    .radio{
      display:flex;flex-direction:column;gap:10px;padding:14px 16px;
    }
    .option{
      border:1px solid var(--border);
      background:rgba(15,23,42,.65);
      border-radius:14px;
      padding:12px 12px;
      display:flex;align-items:center;justify-content:space-between;gap:10px;
    }
    .option strong{font-weight:1000}
    .option small{color:var(--muted);display:block;margin-top:3px}
    .option input{accent-color: var(--brand)}
    .footer{
      padding:14px 16px;
      display:flex;justify-content:space-between;gap:12px;align-items:center;flex-wrap:wrap;
      border-top:1px solid var(--border);
      background:rgba(15,23,42,.55);
    }
    .total{font-size:18px;font-weight:1000}
    @media (max-width: 900px){
      .topbar{position:relative;top:0}
      .grid{grid-template-columns:1fr}
    }
  </style>
</head>
<body>
  <div class="container">
    <header class="topbar">
      <div class="brand">
        <div class="logo">✅</div>
        <div>
          <h1>PizzaPlanet</h1>
          <p>Checkout (mock payment)</p>
        </div>
      </div>
      <div class="actions">
        <a class="btn btn-ghost" href="{{ route('cart.show') }}">← Back to cart</a>
      </div>
    </header>

    @if($errors->any())
      <div class="flash err">
        <ul style="margin:0 0 0 18px;">
          @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
      </div>
    @endif

    <div class="grid">
      <section class="card">
        <div class="card-head">
          <div>
            <h2>Order review</h2>
            <div class="meta">Currency: <code>{{ $currency }}</code></div>
          </div>
          <div class="meta">Items: {{ count($items) }}</div>
        </div>

        <table>
          <thead>
            <tr>
              <th>Item</th>
              <th style="width:90px;">Qty</th>
              <th style="width:160px;">Line</th>
            </tr>
          </thead>
          <tbody>
            @foreach($items as $it)
              <tr>
                <td>
                  <strong>{{ $it['name'] }}</strong>
                  @if(!empty($it['toppings']))
                    <div class="meta" style="margin-top:6px;">
                      Toppings: {{ collect($it['toppings'])->pluck('name')->join(', ') }}
                    </div>
                  @endif
                </td>
                <td>{{ $it['qty'] }}</td>
                <td class="money">{{ $currency }} {{ number_format($it['line_total_minor']/100, 2) }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <div class="footer">
          <div>
            <div class="meta">Total</div>
            <div class="total">{{ $currency }} {{ number_format($subtotalMinor/100, 2) }}</div>
          </div>
        </div>
      </section>

      <section class="card">
        <div class="card-head">
          <div>
            <h2>Payment</h2>
            <div class="meta">We only log the method (no real charge).</div>
          </div>
        </div>

        <form method="POST" action="{{ route('checkout.process') }}">
          @csrf

          <div class="radio">
            <label class="option">
              <div>
                <strong>Card</strong>
                <small>Fast checkout</small>
              </div>
              <input type="radio" name="payment_method" value="card" checked>
            </label>

            <label class="option">
              <div>
                <strong>PayPal</strong>
                <small>Mock PayPal flow</small>
              </div>
              <input type="radio" name="payment_method" value="paypal">
            </label>
          </div>

          <div class="footer">
            <div class="meta">Logs saved to <code>storage/logs/payments.log</code></div>
            <button class="btn btn-primary" type="submit">Place order →</button>
          </div>
        </form>
      </section>
    </div>
  </div>
</body>
</html>
