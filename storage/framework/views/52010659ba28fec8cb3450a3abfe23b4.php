<!-- resources/views/home/xendit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran via Xendit</title>
</head>
<body>
    <h2>Pembayaran</h2>

    <?php if(isset($invoice_url)): ?>
        <p>Silakan klik tombol di bawah untuk menyelesaikan pembayaran:</p>
        <a href="<?php echo e($invoice_url); ?>" target="_blank">
            <button>Bayar Sekarang</button>
        </a>
    <?php else: ?>
    <form action="<?php echo e(route('xendit.post')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <label>Nama:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Jumlah (IDR):</label><br>
        <input type="number" name="amount" min="1000" required><br><br>

        <button type="submit">Generate Invoice</button>
    </form>
    <?php endif; ?>
</body>
</html>
<?php /**PATH E:\Kampung_Jahe_Ecommerce\resources\views/home/xendit.blade.php ENDPATH**/ ?>