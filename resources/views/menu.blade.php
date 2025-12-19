<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>PizzaPlanet Menu</title>
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
    .pill{
      display:inline-flex;align-items:center;gap:8px;
      padding:10px 12px;border-radius:999px;
      border:1px solid var(--border);
      background:rgba(17,28,53,.75);
      font-weight:700;font-size:13px;
    }
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
    .flash.ok{border-color: rgba(34,197,94,.35); box-shadow:0 10px 24px rgba(34,197,94,.10)}
    .flash.err{border-color: rgba(239,68,68,.35); box-shadow:0 10px 24px rgba(239,68,68,.10)}
    .flash strong{display:block;margin-bottom:6px}
    .flash ul{margin:8px 0 0 18px;color:var(--text)}
    .grid{
      margin-top:16px;
      display:grid;
      grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));
      gap:14px;
    }
    .card{
      border:1px solid var(--border);
      background:rgba(17,28,53,.62);
      border-radius:var(--radius);
      box-shadow: var(--shadow);
      overflow:hidden;
    }
    .card-inner{padding:14px}
    .card-head{display:flex;justify-content:space-between;gap:10px;align-items:flex-start}
    .card h3{margin:0;font-size:16px;font-weight:900;letter-spacing:.2px}
    .price{
      font-size:13px;color:var(--muted);
      margin-top:6px;display:flex;gap:8px;align-items:center;flex-wrap:wrap;
    }
    .tag{
      font-size:11px;font-weight:900;letter-spacing:.3px;
      padding:6px 10px;border-radius:999px;
      border:1px solid var(--border);
      background:rgba(15,23,42,.65);
      color:var(--text);
    }
    .tag.custom{border-color: rgba(245,158,11,.35); background: rgba(245,158,11,.12)}
    .form{
      margin-top:12px;
      display:flex;flex-direction:column;gap:10px;
    }
    .field{display:flex;gap:10px;align-items:center;justify-content:space-between}
    .label{font-size:12px;color:var(--muted);font-weight:700}
    input[type="number"]{
      width:92px;
      padding:10px 12px;border-radius:12px;
      border:1px solid var(--border);
      background:rgba(15,23,42,.85);
      color:var(--text);
      outline:none;
    }
    input[type="number"]:focus{border-color: rgba(245,158,11,.55)}
    .hint{font-size:12px;color:var(--muted);line-height:1.3}
    .toppings{
      display:grid;
      grid-template-columns:repeat(2, minmax(0,1fr));
      gap:8px;
    }
    .chip{
      display:flex;align-items:center;gap:8px;
      padding:10px 10px;border-radius:14px;
      border:1px solid var(--border);
      background:rgba(15,23,42,.70);
      transition: border-color .12s ease, transform .12s ease;
    }
    .chip:hover{border-color: rgba(255,255,255,.18)}
    .chip input{accent-color: var(--brand)}
    .chip span{font-size:13px;font-weight:700}
    .footer{
      padding:12px 14px;border-top:1px solid var(--border);
      display:flex;justify-content:space-between;gap:10px;align-items:center;
      background:rgba(15,23,42,.55);
    }
    .footer small{color:var(--muted)}
    @media (max-width: 520px){
      .topbar{position:relative;top:0}
      .field{flex-direction:column;align-items:flex-start}
      input[type="number"]{width:100%}
      .toppings{grid-template-columns:1fr}
      .actions{width:100%;justify-content:flex-end}
    }
  </style>
</head>
<body>
  <div class="container">
    <header class="topbar">
      <div class="brand">
        <div class="logo">🍕</div>
        <div>
          <h1>PizzaPlanet</h1>
          <p>Order fast. Pay later (mock).</p>
        </div>
      </div>
      <div class="actions">
        <a class="btn btn-ghost" href="{{ route('cart.show') }}">🛒 View Cart</a>
      </div>
    </header>

    @if(session('success'))
      <div class="flash ok">{{ session('success') }}</div>
    @endif

    @if($errors->any())
      <div class="flash err">
        <strong>Fix these:</strong>
        <ul>
          @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
      </div>
    @endif

    <div class="grid">
      @foreach($pizzas as $pizza)
        <div class="card">
          <div class="card-inner">
            <div class="card-head">
              <div>
                <h3>{{ $pizza->name }}</h3>
                <div class="price">
                  <span>Base: <strong>{{ $pizza->currency }} {{ number_format($pizza->base_price_minor/100, 2) }}</strong></span>
                  @if($pizza->code === 'custom')
                    <span class="tag custom">MAKE YOUR OWN</span>
                  @else
                    <span class="tag">SIGNATURE</span>
                  @endif
                </div>
              </div>
              <span class="tag">{{ $pizza->currency }}</span>
            </div>

            <form class="form" method="POST" action="{{ route('cart.add') }}">
              @csrf
              <input type="hidden" name="pizza_code" value="{{ $pizza->code }}">

              <div class="field">
                <div>
                  <div class="label">Quantity</div>
                  <div class="hint">Add multiple pizzas per order</div>
                </div>
                <input type="number" name="qty" min="1" max="20" value="1">
              </div>

              @if($pizza->code === 'custom')
                <div>
                  <div class="label">Toppings</div>
                  <div class="hint">Choose up to 4 toppings ({{ $pizza->currency }} 1.00 each)</div>
                  <div class="toppings" style="margin-top:10px">
                    @foreach($toppings as $t)
                      <label class="chip">
                        <input type="checkbox" name="toppings[]" value="{{ $t->id }}">
                        <span>{{ $t->name }}</span>
                      </label>
                    @endforeach
                  </div>
                </div>
              @endif

              <div class="footer">
                <small>Ready when you are.</small>
                <button class="btn btn-primary" type="submit">Add to cart →</button>
              </div>
            </form>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</body>
</html>
