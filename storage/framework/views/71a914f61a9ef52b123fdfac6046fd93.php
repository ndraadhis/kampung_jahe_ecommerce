<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya</title>
    <?php echo $__env->make('home.css', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

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

    <?php echo $__env->make('home.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="order-container">
        <h2>Pesanan Saya</h2>

        <?php
            $groupedOrders = $orders->groupBy('transaction_code');
        ?>

        <?php $__currentLoopData = $groupedOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transactionCode => $orderGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $first = $orderGroup->first(); ?>

            <div class="order-card">
                <!-- Info Transaksi -->
                <div class="order-header">
                    Transaksi: <?php echo e($transactionCode); ?> |
                    Ekspedisi: <?php echo e($first->shipping_provider ?? '-'); ?> |
                    | Resi: <?php echo e($first->resi ?? '-'); ?>

                </div>

                <!-- Daftar Produk -->
                <?php $__currentLoopData = $orderGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="product-item">
                        <div class="product-img">
                            <img src="<?php echo e(asset('products/' . ($order->product->image ?? 'default.png'))); ?>" alt="Gambar Produk">
                        </div>
                        <div class="product-info">
                            <div class="product-title"><?php echo e($order->product->title ?? 'Produk dihapus'); ?></div>
                            <div>Harga: Rp<?php echo e(number_format($order->product->price ?? 0, 0, ',', '.')); ?></div>
                            <div>
                                Status:
                                <?php switch($order->status):
                                    case ('waiting'): ?> Konfirmasi <?php break; ?>
                                    <?php case ('in progress'): ?> Sedang Diproses <?php break; ?>
                                    <?php case ('On the way'): ?> Dalam Pengiriman <?php break; ?>
                                    <?php case ('Delivered'): ?> Selesai <?php break; ?>
                                    <?php default: ?> -
                                <?php endswitch; ?>
                            </div>
                        </div>

                        <!-- Aksi (Batal) -->
                        <div class="order-actions">
                            <?php if($order->status == 'in progress'): ?>
                                <form action="<?php echo e(route('user.cancel.order', $order->id)); ?>" method="POST" class="cancel-order-form">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn-cancel" type="submit">Batal</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <!-- Tombol Invoice -->
                <div class="order-actions">
                    <a href="<?php echo e(route('user.invoice.all')); ?>" class="btn-invoice" target="_blank">Lihat Invoice</a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php echo $__env->make('home.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

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
<?php /**PATH E:\Kampung_Jahe_Ecommerce\resources\views/home/order.blade.php ENDPATH**/ ?>