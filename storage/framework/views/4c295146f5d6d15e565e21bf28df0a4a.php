<!DOCTYPE html>
<html>

<head>
    <?php echo $__env->make('home.css', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <style type="text/css">
        .div_deg {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 50px;
            margin: 60px;
        }

        table {
            border: 2px solid black;
            text-align: center;
            width: 800px;
        }

        th {
            border: 2px solid black;
            text-align: center;
            color: white;
            font-size: 20px;
            font-weight: bold;
            background: black;
        }

        td {
            border: 1px solid skyblue;
        }

        .cart_value {
            text-align: center;
            margin-bottom: 70px;
            padding: 18px;
        }

        .order_deg {
            width: 400px;
        }

        .form_row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 20px;
        }

        .form_row label {
            width: 140px;
            font-weight: bold;
            margin-top: 6px;
        }

        .form_row input[type="text"],
        .form_row textarea,
        .form_row input[type="number"] {
            flex: 1;
            padding: 6px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form_row textarea {
            resize: vertical;
            height: 80px;
        }

        .form_row input[type="submit"] {
            margin-left: 150px;
        }

        .form_left {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        <!-- header section starts -->
        <?php echo $__env->make('home.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <!-- end header section -->
    </div>

    <div class="div_deg">
        <!-- Order Form -->
        <div class="order_deg">
            <form action="<?php echo e(url('confirm_order')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="form_row">
                    <label>Nama</label>
                    <input type="text" name="name" value="<?php echo e(Auth::user()->name); ?>">
                </div>

                <div class="form_row">
                    <label>Alamat</label>
                    <textarea name="address" rows="3"><?php echo e(Auth::user()->address); ?></textarea>
                </div>

                <div class="form_row">
                    <label>No.tlpn</label>
                    <input type="text" name="phone" value="<?php echo e(Auth::user()->phone); ?>">
                </div>

                <div class="form_row">
                    <label for="nominal">Masukkan Nominal</label>
                    <input type="number" name="nominal" id="nominal" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-400" required>
                </div>

                <div class="flex space-x-2">
                    <button type="submit" name="payment_method" value="cash on delivery" class="btn btn-secondary px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                        Cash On Delivery
                    </button>
                    <button type="submit" name="payment_method" value="transfer" class="btn btn-primary px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Bayar
                    </button>
                </div>
            </form>
        </div>

        <!-- Cart Table -->
        <table>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Hapus</th>
            </tr>
            <?php
             $value = 0; 
             ?>
            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($cart->product->title); ?></td>
                <td><?php echo e($cart->product->price); ?></td>
                <td>
                    <img width="150" src="/products/<?php echo e($cart->product->image); ?>">
                </td>
                <td>
                    <a class="btn btn-danger" href="<?php echo e(url('delete_cart', $cart->id)); ?>">Hapus</a>
                </td>
            </tr>
            <?php 
               $value = $value + $cart->product->price;
             ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    </div>

    <div class="cart_value">
    <h3>Total Harga : Rp.<?php echo e($value); ?></h3>

    </div>

    <!-- footer section -->
    <?php echo $__env->make('home.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>

</html><?php /**PATH E:\Kampung_Jahe_Ecommerce\resources\views/home/mycart.blade.php ENDPATH**/ ?>