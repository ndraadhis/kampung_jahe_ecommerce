<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Pesanan Saya</title>
    @include('home.css')
    <style>
        .div_center {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 60px;
            flex-direction: column;
        }
        table {
            border: 2px solid black;
            text-align: center;
            width: 90%;
            max-width: 1000px;
        }
        th {
            border: 2px solid black;
            background-color: black;
            color: white;
            font-size: 19px;
            font-weight: bold;
        }
        td {
            border: 1px solid black;
            padding: 10px;
        }
        img {
            border-radius: 8px;
        }
        .invoice-button {
            margin-top: 30px;
        }
        .btn-success {
            padding: 10px 20px;
            font-size: 15px;
            border: none;
            background-color: #28a745;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-danger {
            padding: 6px 12px;
            font-size: 14px;
            background-color: #dc3545;
            border: none;
            color: white;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="hero_area">
    @include('home.header')

    <div class="div_center">
        <h2>Pesanan Anda</h2>
        <table>
            <thead>
    <tr>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Nomor Transaksi</th> <!-- Tambahan -->
        <th>Status Pengiriman</th>
        <th>Nomor Resi</th>
        <th>Gambar</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
    @foreach($order as $order)
    <tr>
        <td>{{ $order->product->title }}</td>
        <td>Rp{{ number_format($order->product->price, 0, ',', '.') }}</td>

        <td>{{ $order->transaction_code ?? '-' }}</td> <!-- Tambahan -->

        <td>
            @switch($order->status)
                @case('waiting') Konfirmasi @break
                @case('in progress') Sedang Diproses @break
                @case('On the way') Dalam Pengiriman @break
                @case('Delivered') Sedang Diantar @break
                @default - 
            @endswitch
        </td>
        <td>{{ $order->resi ?? '-' }}</td>
        <td>
            <img src="{{ asset('products/' . $order->product->image) }}" alt="gambar produk" width="150">
        </td>
        <td>
            @if($order->status == 'in progress')
            <form action="{{ route('user.cancel.order', $order->id) }}" method="POST" class="cancel-order-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Batal</button>
            </form>
            @else
                <span>-</span>
            @endif
        </td>
    </tr>
    @endforeach
</tbody>

        </table>

        <div class="invoice-button">
            <a href="{{ route('user.invoice.all') }}" class="btn btn-success" target="_blank">
                Lihat Semua Invoice (PDF)
            </a>
        </div>
    </div>
</div>

@include('home.footer')

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.cancel-order-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin membatalkan?',
                text: "Pesanan akan dibatalkan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, batalkan',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
</body>
</html>
