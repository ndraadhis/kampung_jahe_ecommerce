<section class="shop_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>Produk Terbaru</h2>
    </div>

    {{-- Form Pencarian Kategori --}}
    <div class="d-flex justify-content-end mb-4">
      <form action="{{ route('shop.searchCategory') }}" method="GET" class="d-flex" style="max-width: 400px;">
            <input type="text" name="category" placeholder="Cari berdasarkan kategori..." required class="form-control me-2">
          <button type="submit" class="btn btn-success">Cari</button>
      </form>
    </div>

    {{-- Tampilkan hasil pencarian  --}}
    @if(isset($keyword))
      <div class="text-center mb-3">
        <p>Hasil pencarian untuk kategori: <strong>{{ $keyword }}</strong></p>
        <a href="{{ route('shop.index') }}" class="btn btn-secondary">Tampilkan Semua Produk</a>
      </div>
    @endif

    <div class="row">
      @forelse($product as $products)
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <div class="img-box">
              <img src="products/{{ $products->image }}" alt="{{ $products->title }}">
            </div>
            <div class="detail-box">
              <h6>{{ $products->title }}</h6>
              <h6>Harga
                <span>{{($products->price)}}</span>
              </h6>
            </div>
            <div style="padding: 15px">
              <a class="btn btn-danger" href="{{ url('product_details', $products->id) }}">Detail</a>
              <a class="btn btn-primary" href="{{ url('add_cart', $products->id) }}">Tambahkan</a>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center">
          <p>Tidak ada produk ditemukan untuk kategori tersebut.</p>
        </div>
      @endforelse
    </div>
  </div>
</section>
