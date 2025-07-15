<section class="shop_section layout_padding bg-light">
  <div class="container">
    <div class="heading_container heading_center mb-4">
      <h2 class="fw-bold text-dark">Produk Terbaru</h2>
    </div>

    <!-- Form Pencarian Kategori -->
    <div class="d-flex justify-content-end mb-4">
      <form action="{{ route('shop.searchCategory') }}" method="GET" class="d-flex shadow-sm rounded" style="max-width: 400px; width:100%;">
        <input type="text" name="category" placeholder="Cari berdasarkan kategori..." required class="form-control rounded-start">
        <button type="submit" class="btn btn-success rounded-end">Cari</button>
      </form>
    </div>

    <!-- Hasil Pencarian -->
    @if(isset($keyword))
      <div class="text-center mb-3">
        <p class="text-muted">Hasil pencarian untuk kategori: <strong>{{ $keyword }}</strong></p>
        <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary btn-sm">Tampilkan Semua Produk</a>
      </div>
    @endif

    <!-- Daftar Produk -->
    <div class="row g-4">
      @forelse($product as $products)
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="card shadow-sm border-0 h-100">
            <img src="{{ asset('products/' . $products->image) }}" class="card-img-top" alt="{{ $products->title }}" style="height: 180px; width: 100%; object-fit: contain;">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title text-dark">{{ $products->title }}</h5>
              <p class="card-text fw-semibold text-success mb-2">Rp{{ number_format($products->price, 0, ',', '.') }}</p>
              <div class="mt-auto">
                <a href="{{ url('product_details', $products->id) }}" class="btn btn-outline-danger btn-sm w-100 mb-2">Detail</a>
                <a href="{{ url('add_cart', $products->id) }}" class="btn btn-primary btn-sm w-100">Tambahkan ke Keranjang</a>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center">
          <p class="text-muted">Tidak ada produk ditemukan untuk kategori tersebut.</p>
        </div>
      @endforelse
    </div>
  </div>
</section>
