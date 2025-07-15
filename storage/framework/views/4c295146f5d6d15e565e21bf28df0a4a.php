<!DOCTYPE html>
<html>

<head>
  <?php echo $__env->make('home.css', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <style>
    .checkout_container {
      max-width: 1000px;
      margin: 50px auto;
      padding: 20px;
      background-color: #f9f9f9;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .product_detail {
      border-bottom: 1px solid #ccc;
      padding: 15px 0;
    }

    .product_detail h4 {
      margin: 0;
    }

    .total_amount {
      text-align: right;
      font-size: 18px;
      font-weight: bold;
      margin-top: 20px;
    }

    .btn-confirm {
      display: block;
      width: 100%;
      padding: 12px;
      background-color: #28a745;
      color: white;
      text-align: center;
      font-weight: bold;
      text-decoration: none;
      border-radius: 5px;
      margin-top: 20px;
    }

    .btn-confirm:hover {
      background-color: #218838;
    }
  </style>
</head>

<body>
  <?php echo $__env->make('home.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <div class="checkout_container">
    <h2>Detail Pesanan Anda</h2>

    <?php $total = 0; ?>

    <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="product_detail">
        <h4><?php echo e($cart->product->title); ?></h4>
        <p><strong>Harga:</strong> Rp<?php echo e($cart->product->price); ?></p>
        <p><strong>Kategori:</strong> <?php echo e($cart->product->category); ?></p>
        <img src="/products/<?php echo e($cart->product->image); ?>" width="150" style="border-radius: 8px;">
      </div>
      <?php $total += $cart->product->price; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <div class="total_amount">
      Total Harga: Rp<?php echo e($total); ?>

    </div>

    <a href="<?php echo e(url('/proses-pesanan')); ?>" class="btn-confirm">Konfirmasi dan Lanjutkan Pembayaran</a>
  </div>

  <?php echo $__env->make('home.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>

</html>
<?php /**PATH E:\Kampung_Jahe_Ecommerce\resources\views/home/mycart.blade.php ENDPATH**/ ?>