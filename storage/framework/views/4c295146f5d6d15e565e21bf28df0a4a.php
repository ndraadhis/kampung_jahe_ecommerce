<!DOCTYPE html>
<html lang="id">

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
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .product_detail img {
      border-radius: 8px;
      max-width: 120px;
    }

    .product_info {
      flex: 1;
    }

    .total_amount {
      text-align: right;
      font-size: 18px;
      font-weight: bold;
      margin-top: 20px;
    }

    .btn-confirm, .btn-delete {
      display: inline-block;
      padding: 12px 20px;
      font-weight: bold;
      text-decoration: none;
      border-radius: 5px;
      margin-top: 20px;
      text-align: center;
    }

    .btn-confirm {
      background-color: #28a745;
      color: white;
    }

    .btn-confirm:hover {
      background-color: #218838;
    }

    .btn-delete {
      background-color: #dc3545;
      color: white;
      margin-left: 10px;
      border: none;
    }

    input[type="checkbox"] {
      transform: scale(1.2);
    }

  </style>
</head>

<body>
  <?php echo $__env->make('home.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <div class="checkout_container">
    <h2>Detail Pesanan Anda</h2>

    <form action="<?php echo e(url('/cart/delete-items')); ?>" method="POST">
      <?php echo csrf_field(); ?>

      <?php $total = 0; ?>

      <?php $__empty_1 = true; $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cartItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php if($cartItem->product): ?>
          <div class="product_detail">
            <input type="checkbox" name="delete_items[]" value="<?php echo e($cartItem->id); ?>">
            <div class="product_info">
              <h4><?php echo e($cartItem->product->title); ?></h4>
              <p><strong>Harga:</strong> Rp<?php echo e(number_format($cartItem->product->price, 0, ',', '.')); ?></p>
              <p><strong>Kategori:</strong> <?php echo e($cartItem->product->category); ?></p>
            </div>
            <img src="/products/<?php echo e($cartItem->product->image); ?>" alt="Gambar Produk">
          </div>
          <?php $total += $cartItem->product->price; ?>
        <?php else: ?>
          <div class="product_detail" style="color:red;">
            <p><strong>Produk tidak ditemukan / telah dihapus</strong></p>
          </div>
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p>Keranjang kosong.</p>
      <?php endif; ?>

      <div class="total_amount">
        Total Harga: Rp<?php echo e(number_format($total, 0, ',', '.')); ?>

      </div>

      <div>
        <button type="submit" class="btn-delete">Hapus Item Terpilih</button>
        <a href="<?php echo e(url('/proses-pesanan')); ?>" class="btn-confirm">Konfirmasi dan Lanjutkan Pembayaran</a>
      </div>
    </form>
  </div>

  <?php echo $__env->make('home.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>

</html>
<?php /**PATH E:\Kampung_Jahe_Ecommerce\resources\views/home/mycart.blade.php ENDPATH**/ ?>