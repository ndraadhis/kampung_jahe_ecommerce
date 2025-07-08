<!-- resources/views/home/xendit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran via Xendit</title>
</head>
<body>
    <h2>Pembayaran</h2>

    @if(isset($invoice_url))
        <p>Silakan klik tombol di bawah untuk menyelesaikan pembayaran:</p>
        <a href="{{ $invoice_url }}" target="_blank">
            <button>Bayar Sekarang</button>
        </a>
    @else
    <form action="{{ route('xendit.post') }}" method="POST">
        @csrf
        <label>Nama:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Jumlah (IDR):</label><br>
        <input type="number" name="amount" min="1000" required><br><br>

        <button type="submit">Generate Invoice</button>
    </form>
    @endif
</body>
</html>
