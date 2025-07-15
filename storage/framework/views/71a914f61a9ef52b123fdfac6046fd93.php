<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Pesanan Saya</title>
    <?php echo $__env->make('home.css', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
    <?php echo $__env->make('home.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="div_center">
        <h2>Pesanan Anda</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Status Pengiriman</th>
                    <th>Nomor Resi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($order->product->title); ?></td>
                    <td>Rp<?php echo e(number_format($order->product->price, 0, ',', '.')); ?></td>
                    <td>
                        <?php switch($order->status):
                            case ('in progress'): ?> Sedang Diproses <?php break; ?>
                            <?php case ('On the way'): ?> Dalam Pengiriman <?php break; ?>
                            <?php case ('Delivered'): ?> Selesai <?php break; ?>
                            <?php default: ?> - 
                        <?php endswitch; ?>
                    </td>
                    <td><?php echo e($order->resi ?? '-'); ?></td>
                    <td>
                        <img src="<?php echo e(asset('products/' . $order->product->image)); ?>" alt="gambar produk" width="150">
                    </td>
                    <td>
                        <?php if($order->status == 'in progress'): ?>
                        <form action="<?php echo e(route('user.cancel.order', $order->id)); ?>" method="POST" class="cancel-order-form">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger">Batal</button>
                        </form>
                        <?php else: ?>
                            <span>-</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <div class="invoice-button">
            <a href="<?php echo e(route('user.invoice.all')); ?>" class="btn btn-success" target="_blank">
                Lihat Semua Invoice (PDF)
            </a>
        </div>
    </div>
</div>

<?php echo $__env->make('home.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

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
<?php /**PATH E:\Kampung_Jahe_Ecommerce\resources\views/home/order.blade.php ENDPATH**/ ?>