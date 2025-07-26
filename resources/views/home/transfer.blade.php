<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pembayaran</title>
    @include('home.css')
    <style>
        body {
            background-color: #f5f5f5;
        }
        .container {
            max-width: 750px;
            margin: 60px auto;
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-bottom: 100px;
        }
        h2 {
            color: #28a745;
            margin-bottom: 20px;
            text-align: center;
        }
        .detail {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .detail p {
            margin: 8px 0;
        }
        .detail strong {
            display: inline-block;
            width: 140px;
        }
        .bank-info {
            margin-top: 20px;
        }
        .btn {
            padding: 10px 18px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-upload {
            background-color: #17a2b8;
            color: white;
        }
        .btn-confirm {
            background-color: #28a745;
            color: white;
        }
        .btn-invoice {
            background-color: #007bff;
            color: white;
            margin-top: 30px;
            display: inline-block;
        }
        select, input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 10px;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Konfirmasi Pembayaran via Transfer</h2>
    <p>Silakan transfer sesuai total tagihan dalam waktu <strong>1x24 jam</strong> dan unggah bukti pembayaran.</p>

    <!-- TABEL PRODUK -->
    <h3>Detail Produk yang Dibeli</h3>
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
                $subtotal = $product->price * ($item->quantity ?? 1);
                $total += $subtotal;
            @endphp
            <tr>
                <td>{{ $product->title }}</td>
                <td>{{ $item->quantity ?? 1 }}</td>
                <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                <td>Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
            </tr>
        @endforeach

        <tr>
            <td colspan="3">Ongkir ({{ $order->shipping_provider }})</td>
            <td>Rp{{ number_format($shippingCost, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="3"><strong>Total Pembayaran</strong></td>
            <td><strong>Rp{{ number_format($total + $shippingCost, 0, ',', '.') }}</strong></td>
        </tr>
        </tbody>
    </table>

    <hr style="margin: 30px 0;">

    <!-- Form untuk simpan bank tujuan -->
    <form action="{{ route('set.bank.tujuan', $order->id) }}" method="POST">
        @csrf
        <label for="bank">Pilih Bank Tujuan:</label>
        <select id="bank" name="bank_tujuan" onchange="this.form.submit()" required>
            <option value="">-- Pilih Bank --</option>
            <option value="bri" {{ $order->bank_tujuan == 'bri' ? 'selected' : '' }}>BRI</option>
            <option value="bni" {{ $order->bank_tujuan == 'bni' ? 'selected' : '' }}>BNI</option>
            <option value="mandiri" {{ $order->bank_tujuan == 'mandiri' ? 'selected' : '' }}>Mandiri</option>
        </select>
    </form>

    @php
        $banks = [
            'bri' => ['BRI', '1234 5678 9101 1121'],
            'bni' => ['BNI', '9876 5432 1000 1112'],
            'mandiri' => ['Mandiri', '5550 0123 4567 8910']
        ];
        $selected = strtolower($order->bank_tujuan);
    @endphp

    @if(isset($banks[$selected]))
        <div class="detail bank-info">
            <p><strong>Bank:</strong> {{ $banks[$selected][0] }}</p>
            <p><strong>No. Rekening:</strong> {{ $banks[$selected][1] }}</p>
            <p><strong>Atas Nama:</strong> Kampung Jahe Pulesari</p>
        </div>
    @endif

    <!-- Info Pemesan -->
    <div class="detail">
        <p><strong>Nama:</strong> {{ $order->name }}</p>
        <p><strong>Alamat:</strong> {{ $order->rec_address }}</p>
        <p><strong>No. HP:</strong> {{ $order->phone }}</p>
        <p><strong>Tgl Pesan:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>
        <p><strong>No. Transaksi:</strong> {{ $order->transaction_code }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        <p><strong>Waktu Sisa Pembayaran:</strong> <span id="countdown">Memuat...</span></p>
    </div>

    <!-- Form Upload Bukti -->
    <form action="{{ url('/upload-transfer-proof/'.$order->id) }}" method="POST" enctype="multipart/form-data" id="upload-form">
        @csrf
        @if (!$order->bukti_transfer)
            <label>Unggah Bukti Transfer:</label>
            <input type="file" name="transfer_proof" accept="image/*,.pdf" required>
            <button type="submit" class="btn btn-upload" style="margin-top:10px;">Upload</button>
        @else
            <p><strong>Bukti Transfer:</strong></p>
            <a href="{{ asset('bukti_transfer/'.$order->bukti_transfer) }}" target="_blank">
                <img src="{{ asset('bukti_transfer/'.$order->bukti_transfer) }}" width="150">
            </a>
        @endif
    </form>

    @if ($order->bukti_transfer)
        <form action="{{ url('/confirm-payment/'.$order->id) }}" method="POST" id="confirm-payment-form" style="margin-top: 20px;">
            @csrf
            <button type="button" class="btn btn-confirm" id="confirm-button">Konfirmasi Pembayaran</button>
        </form>
    @endif

    <a href="{{ route('invoice', $order->id) }}" target="_blank" class="btn btn-invoice">🧾 Cetak Invoice</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('confirm-button')?.addEventListener('click', function () {
        Swal.fire({
            title: 'Konfirmasi Pembayaran?',
            text: 'Pastikan Anda sudah melakukan transfer dan bukti telah diunggah.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Konfirmasi',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('confirm-payment-form').submit();
            }
        });
    });

    // Countdown logic
    const createdAt = "{{ $order->created_at }}";
    const orderId = "{{ $order->id }}";
    const deadlineKey = `deadline_order_${orderId}`;

    if (!localStorage.getItem(deadlineKey)) {
        const deadline = new Date(createdAt);
        deadline.setHours(deadline.getHours() + 24);
        localStorage.setItem(deadlineKey, deadline.toISOString());
    }

    const deadlineTime = new Date(localStorage.getItem(deadlineKey));

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = deadlineTime - now;

        if (distance < 0) {
            document.getElementById("countdown").innerHTML = "<span style='color:red;'>Waktu Habis</span>";
            const uploadForm = document.getElementById("upload-form");
            if (uploadForm) uploadForm.style.display = 'none';
            const confirmForm = document.getElementById("confirm-payment-form");
            if (confirmForm) confirmForm.style.display = 'none';
            return;
        }

        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("countdown").innerHTML = `${hours}j ${minutes}m ${seconds}d`;
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
</script>
</body>
</html>
