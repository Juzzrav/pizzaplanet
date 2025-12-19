<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Order #{{ $order->id }} · PizzaPlanet</title>
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
      background:linear-gradient(135deg, rgba(34,197,94,1), rgba(255,255,255,.12));
      display:grid;place-items:center;font-size:18px;
      box-shadow:0 10px 26px rgba(34,197,94,.18);
    }
    .brand h1{font-size:16px;margin:0;font-weight:900;letter-spacing:.2px}
    .brand p{margin:2px 0 0;font-size:12px;color:var(--muted)}
    .actions{display:flex;align-items:center;gap:10px;flex-wrap:wrap}
    .btn{
      border:0;cursor:pointer;border-radius:12px;
      padding:10px 12px;font-weight:900;
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
      border:1px solid rgba(34,197,94,.35);
      background:rgba(17,28,53,.70);
      box-shadow:0 10px 24px rgba(34,197,94,.10);
      display:flex;align-items:center;gap:10px;
      font-weight:800;
    }
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
    .chips{margin-top:8px;display:flex;flex-wrap:wrap;gap:8px}
    .chip{
      font-size:12px;font-weight:900;color:var(--text);
      padding:6px 10px;border-radius:999px;border:1px solid var(--border);
      background:rgba(15,23,42,.70);
    }
    .summary{
      padding:14px 16px;
      display:grid;grid-template-columns:1fr 1fr;gap:12px;
    }
    .stat{
      border:1px solid var(--border);
      border-radius:14px;padding:12px;
      background:rgba(15,23,42,.55);
    }
    .stat .k{font-size:12px;color:var(--muted)}
    .stat .v{font-size:16px;font-weight:1000;margin-top:4px}
    .footer{
      padding:14px 16px;border-top:1px solid var(--border);
      background:rgba(15,23,42,.55);
      display:flex;justify-content:space-between;gap:12px;align-items:center;flex-wrap:wrap;
    }
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
        <div class="logo">✓</div>
        <div>
          <h1>Order #{{ $order->id }}</h1>
          <p>Completed order summary</p>
        </div>
      </div>
      <div class="actions">
        <a class="btn btn-ghost" href="{{ route('menu') }}">Order again</a>
      </div>
    </header>

    @if(session('success'))
      <div class="flash">Payment successful · Order placed</div>
    @endif

    <div class="grid">
      <section class="card">
        <div class="card-head">
          <div>
            <h2>Items</h2>
            <div class="meta">All prices in <code>{{ $order->currency }}</code></div>
          </div>
          <div class="meta">{{ $order->items->count() }} item(s)</div>
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
            @foreach($order->items as $it)
              <tr>
                <td>
                  <strong>{{ $it->name_snapshot }}</strong>
                  @if($it->toppings->count())
                    <div class="chips">
                      @foreach($it->toppings as $t)
                        <span class="chip">{{ $t->topping_name_snapshot }}</span>
                      @endforeach
                    </div>
                  @endif
                </td>
                <td>{{ $it->qty }}</td>
                <td class="money">{{ $order->currency }} {{ number_format($it->line_total_minor/100, 2) }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </section>

      <aside class="card">
        <div class="card-head">
          <h2>Order summary</h2>
        </div>

        <div class="summary">
          <div class="stat">
            <div class="k">Status</div>
            <div class="v">{{ strtoupper($order->status) }}</div>
          </div>
          <div class="stat">
            <div class="k">Payment</div>
            <div class="v">{{ strtoupper($order->payment_method) }}</div>
          </div>
          <div class="stat">
            <div class="k">Currency</div>
            <div class="v">{{ $order->currency }}</div>
          </div>
          <div class="stat">
            <div class="k">Total</div>
            <div class="v">{{ $order->currency }} {{ number_format($order->total_minor/100, 2) }}</div>
          </div>
        </div>

        <div class="footer">
          <div class="meta">
            Payment logged to <code>storage/logs/payments.log</code>
          </div>
          <a class="btn btn-primary" href="{{ route('menu') }}">New order →</a>
        </div>
      </aside>
    </div>
  </div>
</body>
</html>
