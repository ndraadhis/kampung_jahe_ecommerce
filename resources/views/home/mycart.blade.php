<!DOCTYPE html>
<html>

<head>
  @include('home.css')
  <style>
    .checkout_container {
      max-width: 1000px;
      margin: 50px auto;
      padding: 20px;
      background-color: #f9f9f9;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .product_detail {
      border-bottom: 1px solid #ccc;
      padding: 15px 0;
    }

    .product_detail h4 {
      margin: 0;
    }

    .total_amount {
      text-align: right;
      font-size: 18px;
      font-weight: bold;
      margin-top: 20px;
    }

    .btn-confirm {
      display: block;
      width: 100%;
      padding: 12px;
      background-color: #28a745;
      color: white;
      text-align: center;
      font-weight: bold;
      text-decoration: none;
      border-radius: 5px;
      margin-top: 20px;
    }

    .btn-confirm:hover {
      background-color: #218838;
    }
  </style>
</head>

<body>
  @include('home.header')

  <div class="checkout_container">
    <h2>Detail Pesanan Anda</h2>

    @php $total = 0; @endphp

    @foreach($cart as $cart)
      <div class="product_detail">
        <h4>{{ $cart->product->title }}</h4>
        <p><strong>Harga:</strong> Rp{{ $cart->product->price }}</p>
        <p><strong>Kategori:</strong> {{ $cart->product->category }}</p>
        <img src="/products/{{ $cart->product->image }}" width="150" style="border-radius: 8px;">
      </div>
      @php $total += $cart->product->price; @endphp
    @endforeach

    <div class="total_amount">
      Total Harga: Rp{{ $total }}
    </div>

    <a href="{{ url('/proses-pesanan') }}" class="btn-confirm">Konfirmasi dan Lanjutkan Pembayaran</a>
  </div>

  @include('home.footer')
</body>

</html>
