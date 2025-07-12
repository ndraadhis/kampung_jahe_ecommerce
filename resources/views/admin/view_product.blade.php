<!DOCTYPE html>
<html>
<head> 
  @include('admin.css')
  <style type="text/css">
    body {
      background-color: #f4f6f9;
      font-family: 'Segoe UI', sans-serif;
    }

    .div_deg {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin: 40px auto;
      padding: 20px;
      background-color: #2c3e50;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
      width: 95%;
      overflow-x: auto;
    }

    .table_deg {
      width: 100%;
      border-collapse: collapse;
      color: white;
    }

    th, td {
      border: 1px solid #1abc9c;
      padding: 12px;
      text-align: center;
      vertical-align: middle;
    }

    th {
      background-color: #1abc9c;
      font-size: 16px;
      font-weight: bold;
    }

    td img {
      max-width: 100px;
      border-radius: 5px;
    }

    .btn {
      margin: 2px;
      padding: 6px 12px;
      font-size: 14px;
    }

    .search-wrapper {
      display: flex;
      justify-content: flex-end;
      margin: 20px 0;
    }

    .search-wrapper input[type='search'] {
      width: 250px;
      height: 38px;
      padding: 6px 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .search-wrapper input[type='submit'] {
      height: 38px;
      border-radius: 4px;
      margin-left: 8px;
    }

    .pagination-wrapper {
      margin-top: 20px;
    }

    .pagination li {
      margin: 0 3px;
    }

    .pagination li a,
    .pagination li span {
      padding: 8px 12px;
      background-color: #f0f0f0;
      border-radius: 5px;
      text-decoration: none;
      color: #333;
    }

    .pagination .active span {
      background-color: #1abc9c;
      color: white;
      font-weight: bold;
    }

    @media (max-width: 768px) {
      th, td {
        font-size: 13px;
        padding: 8px;
      }

      .search-wrapper {
        flex-direction: column;
        align-items: flex-start;
      }

      .search-wrapper input[type='search'] {
        width: 100%;
        margin-bottom: 10px;
      }
    }
  </style>
</head>

<body>
  @include('admin.header')
  @include('admin.sidebar')

  <div class="page-content">
    <div class="page-header">
      <div class="container-fluid">

        <!-- Form Search -->
        <div class="search-wrapper">
          <form action="{{ url('product_search') }}" method="get">
            @csrf
            <input type="search" name="search" placeholder="Cari produk...">
            <input type="submit" class="btn btn-secondary" value="Search">
          </form>
        </div>

        <!-- Tabel Produk -->
        <div class="div_deg">
          <table class="table_deg">
            <thead>
              <tr>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Gambar</th>
                <th>Edit</th>
                <th>Hapus</th>
              </tr>
            </thead>
            <tbody>
              @foreach($product as $products)
              <tr>
                <td>{{ $products->title }}</td>
                <td>{{ $products->description }}</td>
                <td>{{ $products->category }}</td>
                <td>Rp{{ number_format($products->price, 0, ',', '.') }}</td>
                <td>{{ $products->quantity }}</td>
                <td>
                  <img src="{{ asset('products/'.$products->image) }}" alt="Gambar Produk">
                </td>
                <td>
                  <a class="btn btn-success" href="{{ url('update_product', $products->id) }}">Edit</a>
                </td>
                <td>
                  <a class="btn btn-danger" onclick="confirmation(event)" href="{{ url('delete_product', $products->id) }}">Hapus</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          <!-- Pagination -->
          <div class="pagination-wrapper">
            {{ $product->onEachSide(1)->links() }}
          </div>
        </div>

      </div>   
    </div>
  </div>

  @include('admin.js')
</body>
</html>
