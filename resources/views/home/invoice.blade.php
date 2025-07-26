<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Pembayaran</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f6f6f6;
            margin: 0;
            padding: 40px;
        }
        .invoice-container {
            background: #fff;
            padding: 30px 40px;
            max-width: 800px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .info {
            margin-top: 30px;
        }
        .info p {
            margin: 6px 0;
        }
        .detail-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }
        .detail-table th, .detail-table td {
            border: 1px solid #ccc;
            padding: 10px 14px;
            text-align: left;
        }
        .detail-table th {
            background-color: #f2f2f2;
        }
        .total {
            text-align: right;
            font-weight: bold;
        }
        .bank-info {
            margin-top: 30px;
        }
        .bank-info p {
            margin: 6px 0;
        }
        .note {
            margin-top: 40px;
            font-size: 14px;
            color: #a00;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }
    </style>
</head>
<body>
<div class="invoice-container">
    <h2>🧾 Invoice Pembayaran</h2>

    <div class="info">
        <p><strong>Nama:</strong> {{ $order->name }}</p>
        <p><strong>Alamat:</strong> {{ $order->rec_address }}</p>
        <p><strong>No. Telepon:</strong> {{ $order->phone }}</p>
        <p><strong>Tanggal Pemesanan:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>
        <p><strong>No. Transaksi:</strong> {{ $order->transaction_code }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
    </div>

    <table class="detail-table">
        <thead>
        <tr>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Subtotal</th>
        </tr>
        </thead>
        <tbody>
        @php
            $total = 0;
            $shippingRates = [
                'JNE' => 20000,
                'J&T' => 18000,
                'SiCepat' => 17000,
                'Pos Indonesia' => 15000,
                'AnterAja' => 16000,
                'GrabExpress' => 25000,
                'GoSend' => 24000,
            ];
            $shippingCost = $shippingRates[$order->shipping_provider] ?? 0;
        @endphp

        @foreach ($orderList as $item)
            @php
                $product = $item->product;
                $quantity = $item->quantity ?? 1;
                $subtotal = $product->price * $quantity;
                $total += $subtotal;
            @endphp
            <tr>
                <td>{{ $product->title }}</td>
                <td>{{ $quantity }}</td>
                <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                <td>Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
            </tr>
        @endforeach

        <tr>
            <td colspan="3" class="total">Ongkir ({{ $order->shipping_provider }})</td>
            <td>Rp{{ number_format($shippingCost, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="3" class="total">Total Pembayaran</td>
            <td><strong>Rp{{ number_format($total + $shippingCost, 0, ',', '.') }}</strong></td>
        </tr>
        </tbody>
    </table>

    <div class="bank-info">
        <h4>Bank Tujuan Transfer</h4>
        @php
            $bankDetails = [
                'bri' => ['BRI', '1234 5678 9101 1121'],
                'bni' => ['BNI', '9876 5432 1000 1112'],
                'mandiri' => ['Mandiri', '5550 0123 4567 8910'],
            ];
            $bankSelected = strtolower($order->bank_tujuan ?? '');
            $bankInfo = $bankDetails[$bankSelected] ?? null;
        @endphp

        @if ($bankInfo)
            <p><strong>Bank:</strong> {{ $bankInfo[0] }}</p>
            <p><strong>No. Rekening:</strong> {{ $bankInfo[1] }}</p>
            <p><strong>Atas Nama:</strong> Kampung Jahe Pulesari</p>
        @else
            <p><em>Bank tujuan belum dipilih atau belum disimpan saat checkout.</em></p>
        @endif
    </div>

    <div class="note">
        <p><strong>Catatan:</strong> Jika pembayaran tidak dilakukan dalam waktu yang telah ditentukan, maka pesanan akan dianggap <strong>dibatalkan</strong> secara otomatis oleh sistem.</p>
    </div>
</div>
</body>
</html>
