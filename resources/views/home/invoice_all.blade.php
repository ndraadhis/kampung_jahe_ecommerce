<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Semua Invoice</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 30px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
        h2 { margin-top: 40px; }
    </style>
</head>
<body>
    <h1>Daftar Semua Pesanan</h1>

    @foreach($orders as $order)
        <h2>Pesanan #{{ $order->id }}</h2>
        <table>
            <tr><th>Nama</th><td>{{ $order->name }}</td></tr>
            <tr><th>Alamat</th><td>{{ $order->rec_address }}</td></tr>
            <tr><th>No. Telepon</th><td>{{ $order->phone }}</td></tr>
            <tr><th>Produk</th><td>{{ $order->product->title }}</td></tr>
            <tr><th>Pembayaran</th><td>{{ $order->payment_status}}</td></tr>
            <tr><th>Harga</th><td>Rp{{ number_format($order->product->price, 0, ',', '.') }}</td></tr>
            <tr><th>Nomor Transaksi</th><td>{{ $order->transaction_code ?? '-' }}</td></tr>
            <tr><th>Nomor Resi</th><td>{{ $order->resi ?? '-' }}</td></tr>
        </table>
    @endforeach
</body>
</html>
