<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pesanan Transfer</title>
    @include('home.css')
    <style>
        .confirmation-container {
            max-width: 700px;
            margin: 80px auto;
            background-color: #fefefe;
            padding: 40px;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .confirmation-container h2 {
            color: #28a745;
            margin-bottom: 20px;
        }
        .detail-box {
            background-color: #f9f9f9;
            padding: 20px;
            text-align: left;
            margin-top: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .detail-box strong {
            display: inline-block;
            width: 150px;
        }
        .btn-upload {
            margin-top: 20px;
            padding: 10px 18px;
            font-size: 14px;
            border: none;
            background-color: #17a2b8;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        .timer {
            font-weight: bold;
            font-size: 18px;
            margin-top: 15px;
            color: red;
        }
        table {
            margin-top: 30px;
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #ccc;
            padding: 12px;
            font-size: 14px;
        }
        table th {
            background-color: #f2f2f2;
        }
        select, input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="confirmation-container">
    <h2>Pesanan Anda Telah Tercatat</h2>
    <p>Silakan selesaikan pembayaran Anda melalui transfer bank dalam waktu <strong>1x24 jam</strong>.</p>

    <!-- PILIH BANK -->
    <div style="margin-top: 20px; text-align: left;">
        <label for="bank">Pilih Bank Tujuan Transfer:</label>
        <select id="bank" onchange="showBankDetails(this.value)">
            <option value="">-- Pilih Bank --</option>
            <option value="bri">BRI</option>
            <option value="bni">BNI</option>
            <option value="mandiri">Mandiri</option>
        </select>
    </div>

    <div id="bank-info" class="detail-box" style="display: none;"></div>

    <!-- TIMER -->
    <div class="timer">
        Sisa waktu pembayaran: <span id="countdown">23:59:59</span>
    </div>

    <!-- TABEL PRODUK -->
    <h3 style="margin-top: 40px;">Detail Produk yang Dibeli</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach ($orderList as $item)
                @php
                    $product = $item->product;
                    $subtotal = $product->price;
                    $total += $subtotal;
                @endphp
                <tr>
                    <td>{{ $product->title }}</td>
                    <td>1</td>
                    <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" style="text-align:right; font-weight:bold;">Total:</td>
                <td><strong>Rp{{ number_format($total, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    <!-- INFORMASI USER -->
    <div class="detail-box">
        <p><strong>Nama:</strong> {{ $order->name }}</p>
        <p><strong>Alamat:</strong> {{ $order->rec_address }}</p>
        <p><strong>No. Telepon:</strong> {{ $order->phone }}</p>
        <p><strong>Tanggal Pemesanan:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>
        <p><strong>No. Resi:</strong> {{ $order->resi }}</p>
        <p><strong>No. Transaksi:</strong> {{ $order->transaction_code }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

        @if ($order->bukti_transfer)
            <p><strong>Bukti Transfer:</strong><br>
                <a href="{{ asset('bukti_transfer/'.$order->bukti_transfer) }}" target="_blank">
                    <img src="{{ asset('bukti_transfer/'.$order->bukti_transfer) }}" width="150">
                </a>
            </p>
            <div style="text-align: right; margin-top: 20px;">
                <form action="{{ url('/confirm-payment/'.$order->id) }}" method="POST" id="confirm-payment-form">
                    @csrf
                    <button type="button" id="confirm-button" class="btn-upload" style="background-color:#28a745;">
                        Konfirmasi Pembayaran
                    </button>
                </form>
            </div>
        @else
            <div style="text-align: right; margin-top: 20px;">
                <form action="{{ url('/upload-transfer-proof/'.$order->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="bukti" style="float: left; margin-top: 10px;">Unggah Bukti Transfer</label><br>
                    <input type="file" name="transfer_proof" accept="image/*,.pdf" required style="float: left;"><br>
                    <button type="submit" class="btn-upload">Upload Bukti</button>
                </form>
            </div>
        @endif
    </div>
</div>

@include('home.footer')

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Countdown Timer
    const countdown = document.getElementById('countdown');
    let deadline = new Date("{{ $order->created_at->addDay()->format('Y-m-d H:i:s') }}").getTime();

    let x = setInterval(function () {
        let now = new Date().getTime();
        let distance = deadline - now;

        if (distance <= 0) {
            clearInterval(x);
            countdown.innerHTML = "Waktu Habis - Pesanan Akan Dibatalkan";
        } else {
            let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);
            countdown.innerHTML = hours + "j " + minutes + "m " + seconds + "d";
        }
    }, 1000);

    // Bank Selection Info
    function showBankDetails(bank) {
        let info = {
            bri: `<p><strong>Bank:</strong> BRI</p>
                  <p><strong>No. Rekening:</strong> 1234 5678 9101 1121</p>
                  <p><strong>Atas Nama:</strong> Kampung Jahe Pulesari</p>`,
            bni: `<p><strong>Bank:</strong> BNI</p>
                  <p><strong>No. Rekening:</strong> 9876 5432 1000 1112</p>
                  <p><strong>Atas Nama:</strong> Kampung Jahe Pulesari</p>`,
            mandiri: `<p><strong>Bank:</strong> Mandiri</p>
                      <p><strong>No. Rekening:</strong> 5550 0123 4567 8910</p>
                      <p><strong>Atas Nama:</strong> Kampung Jahe Pulesari</p>`
        };
        const bankBox = document.getElementById('bank-info');
        if (info[bank]) {
            bankBox.style.display = 'block';
            bankBox.innerHTML = info[bank];
        } else {
            bankBox.style.display = 'none';
            bankBox.innerHTML = '';
        }
    }

    // SweetAlert untuk konfirmasi pembayaran
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
</script>

</body>
</html>
