<!DOCTYPE html>
<html>
<head> 
  @include('admin.css')

  <style type="text/css">
    .div_deg {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 60px;
    }

    .table_deg {
      border: 2px solid greenyellow;
      border-collapse: collapse;
      color: white;
      width: 95%;
      margin-bottom: 20px;
    }

    th {
      background-color: skyblue;
      color: white;
      font-size: 20px;
      font-weight: bold;
      padding: 15px;
      border: 1px solid skyblue;
    }

    td {
      border: 1px solid skyblue;
      text-align: center;
      padding: 10px;
    }

    .pagination-wrapper {
      display: flex;
      justify-content: center;
      width: 100%;
      margin-bottom: 30px;
    }

    .pagination li {
      margin: 0 5px;
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
      background-color: skyblue;
      color: white;
      font-weight: bold;
    }

    .search-wrapper {
      display: flex;
      justify-content: flex-end;
      margin: 20px 0;
    }

    .search-wrapper input[type='search'] {
      width: 300px;
      height: 45px;
      margin-right: 10px;
      padding: 5px 10px;
    }
  </style>
</head>
<body>
  @include('admin.header')
  @include('admin.sidebar')

  <div class="page-content">
    <div class="page-header">
      <div class="container-fluid">

        <!-- Form pencarian di kanan -->
        <div class="search-wrapper">
          <form action="{{ url('product_search') }}" method="get">
            @csrf
            <input type="search" name="search" placeholder="Cari produk...">
            <input type="submit" class="btn btn-secondary" value="Search">
          </form>
        </div>

        <!-- Tabel produk -->
        <div class="div_deg">
          <table class="table_deg">
            <tr>
              <th>Nama Produk</th>
              <th>Deskripsi Produk</th>
              <th>Kategori</th>
              <th>Harga</th>
              <th>Jumlah Produk</th>
              <th>Gambar</th>
              <th>Edit Produk</th>
              <th>Hapus</th>
            </tr>

            @foreach($product as $products)
            <tr>
              <td>{{ $products->title }}</td>
              <td>{{ $products->description }}</td>
              <td>{{ $products->category }}</td>
              <td>{{ $products->price }}</td>
              <td>{{ $products->quantity }}</td>
              <td>
                <img height="120" width="120" src="{{ asset('products/'.$products->image) }}">
              </td>
              <td>
                <a class="btn btn-success" href="{{ url('update_product', $products->id) }}">Edit</a>
              </td>
              <td>
                <a class="btn btn-danger" onclick="confirmation(event)" href="{{ url('delete_product', $products->id) }}">Hapus</a>
              </td>
            </tr>
            @endforeach
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
