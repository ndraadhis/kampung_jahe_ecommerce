<!DOCTYPE html>
<html lang="id">

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
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .product_detail img {
      border-radius: 8px;
      max-width: 120px;
    }

    .product_info {
      flex: 1;
    }

    .total_amount {
      text-align: right;
      font-size: 18px;
      font-weight: bold;
      margin-top: 20px;
    }

    .btn-confirm, .btn-delete {
      display: inline-block;
      padding: 12px 20px;
      font-weight: bold;
      text-decoration: none;
      border-radius: 5px;
      margin-top: 20px;
      text-align: center;
    }

    .btn-confirm {
      background-color: #28a745;
      color: white;
    }

    .btn-confirm:hover {
      background-color: #218838;
    }

    .btn-delete {
      background-color: #dc3545;
      color: white;
      margin-left: 10px;
      border: none;
    }

    input[type="checkbox"] {
      transform: scale(1.2);
    }

  </style>
</head>

<body>
  @include('home.header')

  <div class="checkout_container">
    <h2>Detail Pesanan Anda</h2>

    <form action="{{ url('/cart/delete-items') }}" method="POST">
      @csrf

      @php $total = 0; @endphp

      @forelse($cart as $cartItem)
        @if ($cartItem->product)
          <div class="product_detail">
            <input type="checkbox" name="delete_items[]" value="{{ $cartItem->id }}">
            <div class="product_info">
              <h4>{{ $cartItem->product->title }}</h4>
              <p><strong>Harga:</strong> Rp{{ number_format($cartItem->product->price, 0, ',', '.') }}</p>
              <p><strong>Kategori:</strong> {{ $cartItem->product->category }}</p>
            </div>
            <img src="/products/{{ $cartItem->product->image }}" alt="Gambar Produk">
          </div>
          @php $total += $cartItem->product->price; @endphp
        @else
          <div class="product_detail" style="color:red;">
            <p><strong>Produk tidak ditemukan / telah dihapus</strong></p>
          </div>
        @endif
      @empty
        <p>Keranjang kosong.</p>
      @endforelse

      <div class="total_amount">
        Total Harga: Rp{{ number_format($total, 0, ',', '.') }}
      </div>

      <div>
        <button type="submit" class="btn-delete">Hapus Item Terpilih</button>
        <a href="{{ url('/proses-pesanan') }}" class="btn-confirm">Konfirmasi dan Lanjutkan Pembayaran</a>
      </div>
    </form>
  </div>

  @include('home.footer')
</body>

</html>
