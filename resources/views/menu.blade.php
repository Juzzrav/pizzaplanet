<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>PizzaPlanet Menu</title>
  <style>
    body{font-family:Arial;max-width:980px;margin:24px auto;padding:0 12px}
    .grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:12px}
    .card{border:1px solid #ddd;border-radius:10px;padding:14px}
    .row{display:flex;justify-content:space-between;gap:12px}
    .err{background:#ffe3e3;padding:10px;border-radius:8px;margin:10px 0}
    .ok{background:#e6ffed;padding:10px;border-radius:8px;margin:10px 0}
    .btn{padding:10px 12px;border:0;border-radius:8px;cursor:pointer}
    .btn-primary{background:#111;color:#fff}
    .btn-link{background:transparent;border:1px solid #111}
    label{display:block;margin-top:8px}
    .toppings{display:grid;grid-template-columns:repeat(2,1fr);gap:6px;margin-top:8px}
  </style>
</head>
<body>
  <div class="row">
    <h1>🍕 PizzaPlanet Menu</h1>
    <a href="{{ route('cart.show') }}">View Cart</a>
  </div>

  @if(session('success'))
    <div class="ok">{{ session('success') }}</div>
  @endif

  @if($errors->any())
    <div class="err">
      <strong>Fix these:</strong>
      <ul>
        @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif

  <div class="grid">
    @foreach($pizzas as $pizza)
      <div class="card">
        <h3>{{ $pizza->name }}</h3>
        <p><strong>Base:</strong> {{ $pizza->currency }} {{ number_format($pizza->base_price_minor/100, 2) }}</p>

        <form method="POST" action="{{ route('cart.add') }}">
          @csrf
          <input type="hidden" name="pizza_code" value="{{ $pizza->code }}">

          <label>Qty
            <input type="number" name="qty" min="1" max="20" value="1">
          </label>

          @if($pizza->code === 'custom')
            <small>Choose up to 4 toppings (£1 each)</small>
            <div class="toppings">
              @foreach($toppings as $t)
                <label style="margin:0">
                  <input type="checkbox" name="toppings[]" value="{{ $t->id }}">
                  {{ $t->name }}
                </label>
              @endforeach
            </div>
          @endif

          <div style="margin-top:12px">
            <button class="btn btn-primary" type="submit">Add to cart</button>
          </div>
        </form>
      </div>
    @endforeach
  </div>
</body>
</html>
