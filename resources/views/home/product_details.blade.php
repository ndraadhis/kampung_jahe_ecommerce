<!DOCTYPE html>
<html>
<head>
  @include('home.css')
  <style type="text/css">
    .product-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        padding: 40px;
        gap: 40px;
    }

    .product-image {
        flex: 1 1 400px;
        text-align: center;
    }

    .product-details {
        flex: 1 1 400px;
        font-family: 'Segoe UI', sans-serif;
        line-height: 1.7;
    }

    .product-details h3 {
        font-weight: bold;
        font-size: 24px;
    }

    .product-details p {
        margin: 5px 0;
    }

    .price {
        color: #e74c3c;
        font-weight: bold;
    }

    .stock {
        color: #e67e22;
        font-weight: bold;
    }

    .buy-button {
        margin-top: 20px;
    }

    .buy-button .btn {
        padding: 10px 25px;
        font-size: 16px;
    }

    @media screen and (max-width: 768px) {
        .product-container {
            flex-direction: column;
            align-items: center;
        }
    }
  </style>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div class="hero_area">
    @include('home.header')
  </div>

  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center mb-5">
        <h2>PRODUK TERBARU</h2>
      </div>

      <div class="product-container">
        <div class="product-image">
          <img src="/products/{{ $data->image }}" width="400" alt="{{ $data->title }}">
        </div>

        <div class="product-details">
          <h3>{{ $data->title }}</h3>
          <p>Harga: <span class="price">{{ $data->price }}</span></p>
          <p>Kategori: <strong>{{ $data->category }}</strong></p>
          <p>Produk Tersedia: <span class="stock">{{ $data->quantity }}</span></p>

          <p class="mt-3">{{ $data->description }}</p>

          <div class="buy-button">
            @auth
              <a href="{{ url('add_cart', $data->id) }}" class="btn btn-success">Beli Sekarang</a>
            @else
              <button onclick="handleGuestBuy()" class="btn btn-success">Beli Sekarang</button>
            @endauth
          </div>
        </div>
      </div>
    </div>
  </section>

  @include('home.footer')

  <script>
    function handleGuestBuy() {
      Swal.fire({
        title: 'Anda belum login',
        text: 'Apakah Anda sudah memiliki akun?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Login',
        cancelButtonText: 'Daftar',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "{{ route('login') }}";
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          window.location.href = "{{ route('register') }}";
        }
      });
    }
  </script>
</body>
</html>
