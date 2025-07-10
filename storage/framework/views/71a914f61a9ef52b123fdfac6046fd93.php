<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Pesanan Saya</title>
    <?php echo $__env->make('home.css', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <style type="text/css">
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
            text-align: center;
        }
        td {
            border: 1px solid black;
            padding: 10px;
        }
        .logout-form {
            margin-top: 40px;
        }
        .logout-form input {
            padding: 8px 20px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }
        .logout-form input:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
<div class="hero_area">
    <!-- Header -->
    <?php echo $__env->make('home.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Orders Table -->
    <div class="div_center">
        <h2>Pesanan Anda</h2>
        <table>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Status Pengiriman</th>
                <th>Gambar</th>
            </tr>
            <?php $__currentLoopData = $order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($order->product->title); ?></td>
                <td><?php echo e($order->product->price); ?></td>
                <td><?php echo e($order->status); ?></td>
                <td>
                    <img height="200" width="200" src="<?php echo e(asset('products/' . $order->product->image)); ?>" alt="gambar produk">
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>

        <!-- Logout Button -->
        
    </div>
</div>

<!-- Footer -->
<?php echo $__env->make('home.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH E:\Kampung_Jahe_Ecommerce\resources\views/home/order.blade.php ENDPATH**/ ?>