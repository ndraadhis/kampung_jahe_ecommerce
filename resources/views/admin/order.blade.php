<!DOCTYPE html>
<html>
<head> 
  @include('admin.css')
  <style type="text/css">
    body {
      background-color: #f4f6f9;
      font-family: 'Segoe UI', sans-serif;
    }

    .table_container {
      margin: 40px auto;
      padding: 20px;
      background: #2c3e50;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
      width: 95%;
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      color: white;
    }

    th, td {
      border: 1px solid #1abc9c;
      padding: 12px 15px;
      text-align: center;
      vertical-align: middle;
    }

    th {
      background-color: #1abc9c;
      color: white;
      font-size: 16px;
    }

    td img {
      max-width: 120px;
      border-radius: 6px;
    }

    .btn {
      margin: 3px 0;
      padding: 6px 12px;
      font-size: 14px;
    }

    .status-red {
      color: #e74c3c;
      font-weight: bold;
    }

    .status-blue {
      color: #3498db;
      font-weight: bold;
    }

    .status-yellow {
      color: #f1c40f;
      font-weight: bold;
    }

    @media (max-width: 768px) {
      th, td {
        font-size: 13px;
        padding: 8px;
      }
      .table_container {
        padding: 10px;
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
      <div class="table_container">
        <table>
          <thead>
            <tr>
              <th>Nama Pelanggan</th>
              <th>Alamat</th>
              <th>No. Telepon</th>
              <th>No. Transaksi</th>
              <th>Nama Produk</th>
              <th>Harga</th>
              <th>Gambar</th>
              <th>Status Pembayaran</th>
              <th>Bukti Pembayaran</th> <!-- Kolom Baru -->
              <th>No. Resi</th>
              <th>Status</th>
              <th>Ubah Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $data)
            <tr>
              <td>{{ $data->name }}</td>
              <td>{{ $data->rec_address }}</td>
              <td>{{ $data->phone }}</td>
              <td>{{ $data->transaction_code}}</td> 
              <td>{{ $data->product->title }}</td>
              <td>{{ $data->product->price }}</td>
              <td><img src="{{ asset('products/'.$data->product->image) }}" alt="Produk"></td>
              <td>{{ $data->payment_status }}</td>

              <td>
                @if($data->bukti_transfer)
                  <a href="{{ asset('bukti_transfer/'.$data->bukti_transfer) }}" target="_blank">
                    <img src="{{ asset('bukti_transfer/'.$data->bukti_transfer) }}" alt="Bukti" style="width: 100px;">
                  </a>
                  <br>
                  <a href="{{ asset('bukti_transfer/'.$data->bukti_transfer) }}" download class="btn btn-sm btn-outline-light mt-1">Unduh</a>
                @else
                  <span>-</span>
                @endif
              </td>

              <td>{{ $data->resi ?? '-' }}</td>
  <td>
  @if($data->status == 'waiting')
    <span class="status-yellow"> Konfirmasi</span>
  @elseif($data->status == 'in progress')
    <span class="status-red">Sedang diproses</span>
  @elseif($data->status == 'On the way')
    <span class="status-blue">Dalam Pengiriman</span>
  @elseif($data->status == 'Delivered')
    <span class="status-yellow">Sedang di Antar</span>
  @else
    <span>-</span>
  @endif
</td>

<td>
  <a class="btn btn-warning" href="{{ url('waiting', $data->id) }}"> Konfirmasi</a><br>
  <a class="btn btn-primary" href="{{ url('on_the_way', $data->id) }}">Dalam Pengiriman</a><br>
  <a class="btn btn-success" href="{{ url('delivered', $data->id) }}">Sedang di Antar</a><br>
  <form action="{{ route('delete_order', $data->id) }}" method="GET">
    <button type="submit" class="btn btn-danger">Selesai</button>
  </form>
</td>


              
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@include('admin.js')

<script>
  function confirmDelete(id) {
    if (confirm("Yakin ingin menghapus pesanan ini?")) {
      document.getElementById('delete-form-' + id).submit();
    }
  }
</script>

</body>
</html>
