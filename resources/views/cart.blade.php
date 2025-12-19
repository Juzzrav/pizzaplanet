<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>PizzaPlanet Cart</title>
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
    .btn-danger{
      background:rgba(239,68,68,.14);
      color:var(--text);
      border:1px solid rgba(239,68,68,.35);
    }
    .flash{
      margin-top:14px;
      padding:12px 14px;border-radius:14px;
      border:1px solid var(--border);
      background:rgba(17,28,53,.70);
    }
    .flash.ok{border-color: rgba(34,197,94,.35); box-shadow:0 10px 24px rgba(34,197,94,.10)}
    .card{
      margin-top:16px;
      border:1px solid var(--border);
      background:rgba(17,28,53,.62);
      border-radius:var(--radius);
      box-shadow: var(--shadow);
      overflow:hidden;
    }
    .card-head{
      padding:14px 16px;border-bottom:1px solid var(--border);
      display:flex;justify-content:space-between;gap:12px;align-items:flex-start;
      background:rgba(15,23,42,.55);
    }
    .card-head h2{margin:0;font-size:16px;font-weight:900}
    .meta{color:var(--muted);font-size:12px;margin-top:6px}
    table{width:100%;border-collapse:collapse}
    th,td{padding:14px 16px;border-bottom:1px solid rgba(255,255,255,.06);vertical-align:top}
    th{font-size:12px;color:var(--muted);text-transform:uppercase;letter-spacing:.12em}
    .item-title{font-weight:900}
    .chips{margin-top:8px;display:flex;flex-wrap:wrap;gap:8px}
    .chip{
      font-size:12px;font-weight:800;color:var(--text);
      padding:6px 10px;border-radius:999px;border:1px solid var(--border);
      background:rgba(15,23,42,.70);
    }
    .money{font-weight:900}
    .footer{
      padding:14px 16px;
      display:flex;justify-content:space-between;gap:12px;align-items:center;flex-wrap:wrap;
      background:rgba(15,23,42,.55);
      border-top:1px solid var(--border);
    }
    .total{
      font-size:18px;font-weight:1000;letter-spacing:.2px;
    }
    .muted{color:var(--muted);font-size:12px}
    .empty{
      margin-top:16px;
      padding:18px;border:1px solid var(--border);
      border-radius:var(--radius);
      background:rgba(17,28,53,.62);
      box-shadow: var(--shadow);
    }
    @media (max-width: 720px){
      .topbar{position:relative;top:0}
      th:nth-child(2), td:nth-child(2),
      th:nth-child(3), td:nth-child(3){
        display:none;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <header class="topbar">
      <div class="brand">
        <div class="logo">🛒</div>
        <div>
          <h1>PizzaPlanet</h1>
          <p>Your cart & totals</p>
        </div>
      </div>
      <div class="actions">
        <a class="btn btn-ghost" href="{{ route('menu') }}">← Menu</a>
        <form method="POST" action="{{ route('cart.clear') }}" style="margin:0">
          @csrf
          <button class="btn btn-danger" type="submit">Clear cart</button>
        </form>
      </div>
    </header>

    @if(session('success'))
      <div class="flash ok">{{ session('success') }}</div>
    @endif

    @if(empty($items))
      <div class="empty">
        <h2 style="margin:0 0 6px;font-size:18px;font-weight:1000;">Cart is empty</h2>
        <p class="muted" style="margin:0 0 12px;">Add some pizzas from the menu to start an order.</p>
        <a class="btn btn-primary" href="{{ route('menu') }}">Browse menu →</a>
      </div>
    </body></html>
    @php exit; @endphp
    @endif

    <section class="card">
      <div class="card-head">
        <div>
          <h2>Items</h2>
          <div class="meta">Currency locked to: <code>{{ $currency }}</code></div>
        </div>
        <div class="meta">You can add many pizzas per order.</div>
      </div>

      <table>
        <thead>
          <tr>
            <th style="width:52%">Item</th>
            <th style="width:10%">Qty</th>
            <th style="width:18%">Unit</th>
            <th style="width:15%">Line</th>
            <th style="width:5%"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($items as $it)
            <tr>
              <td>
                <div class="item-title">{{ $it['name'] }}</div>

                @if(!empty($it['toppings']))
                  <div class="chips">
                    @foreach($it['toppings'] as $t)
                      <span class="chip">{{ $t['name'] }}</span>
                    @endforeach
                  </div>
                @endif
              </td>
              <td>{{ $it['qty'] }}</td>
              <td>{{ $currency }} {{ number_format($it['unit_price_minor']/100, 2) }}</td>
              <td class="money">{{ $currency }} {{ number_format($it['line_total_minor']/100, 2) }}</td>
              <td>
                <form method="POST" action="{{ route('cart.remove', $it['key']) }}" style="margin:0">
                  @csrf
                  <button class="btn btn-danger" type="submit">✕</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <div class="footer">
        <div>
          <div class="muted">Subtotal</div>
          <div class="total">{{ $currency }} {{ number_format($subtotalMinor/100, 2) }}</div>
        </div>
        <a class="btn btn-primary" href="{{ route('checkout.show') }}">Proceed to checkout →</a>
      </div>
    </section>
  </div>
</body>
</html>
