<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya</title>
    @include('home.css')

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .order-container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 0 15px;
        }

        .order-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 15px;
        }

        .order-header {
            font-weight: bold;
            font-size: 16px;
            color: #555;
            margin-bottom: 10px;
        }

        .product-item {
            display: flex;
            align-items: center;
            gap: 15px;
            border-top: 1px solid #eee;
            padding: 15px 0;
        }

        .product-img img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 6px;
        }

        .product-info {
            flex: 1;
        }

        .product-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .order-actions {
            text-align: right;
            margin-top: 10px;
        }

        .btn-cancel {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-invoice {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>
<body>

    @include('home.header')

    <div class="order-container">
        <h2>Pesanan Saya</h2>

        @php
            $groupedOrders = $orders->groupBy('transaction_code');
        @endphp

        @foreach($groupedOrders as $transactionCode => $orderGroup)
            @php $first = $orderGroup->first(); @endphp

            <div class="order-card">
                <!-- Info Transaksi -->
                <div class="order-header">
                    Transaksi: {{ $transactionCode }} |
                    Ekspedisi: {{ $first->shipping_provider ?? '-' }} |
                    | Resi: {{ $first->resi ?? '-' }}
                </div>

                <!-- Daftar Produk -->
                @foreach($orderGroup as $order)
                    <div class="product-item">
                        <div class="product-img">
                            <img src="{{ asset('products/' . ($order->product->image ?? 'default.png')) }}" alt="Gambar Produk">
                        </div>
                        <div class="product-info">
                            <div class="product-title">{{ $order->product->title ?? 'Produk dihapus' }}</div>
                            <div>Harga: Rp{{ number_format($order->product->price ?? 0, 0, ',', '.') }}</div>
                            <div>
                                Status:
                                @switch($order->status)
                                    @case('waiting') Konfirmasi @break
                                    @case('in progress') Sedang Diproses @break
                                    @case('On the way') Dalam Pengiriman @break
                                    @case('Delivered') Selesai @break
                                    @default -
                                @endswitch
                            </div>
                        </div>

                        <!-- Aksi (Batal) -->
                        <div class="order-actions">
                            @if($order->status == 'in progress')
                                <form action="{{ route('user.cancel.order', $order->id) }}" method="POST" class="cancel-order-form">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-cancel" type="submit">Batal</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach

                <!-- Tombol Invoice -->
                <div class="order-actions">
                    <a href="{{ route('user.invoice.all') }}" class="btn-invoice" target="_blank">Lihat Invoice</a>
                </div>
            </div>
        @endforeach
    </div>

    @include('home.footer')

    <!-- SweetAlert Konfirmasi Batal -->
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
