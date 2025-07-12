<!DOCTYPE html>
<html>

<head>
  <?php echo $__env->make('home.css', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <style type="text/css">
    .div_deg {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      margin: 60px;
    }

    .cart_container {
      width: 100%;
      max-width: 1000px;
    }

    table {
      width: 100%;
      border: 2px solid black;
      text-align: center;
      margin-bottom: 30px;
    }

    th {
      border: 2px solid black;
      color: white;
      font-size: 20px;
      font-weight: bold;
      background: black;
      padding: 10px;
    }

    td {
      border: 1px solid skyblue;
      padding: 10px;
    }

    .cart_value {
      text-align: center;
      margin-bottom: 30px;
      font-weight: bold;
      font-size: 20px;
    }

    .order_deg {
      width: 100%;
      max-width: 600px;
      margin: auto;
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
    .form_row input[type="number"],
    .form_row textarea {
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

    .btn {
      padding: 10px 20px;
      border: none;
      cursor: pointer;
      font-weight: bold;
    }

    .btn-secondary {
      background-color: #6c757d;
      color: white;
      margin-right: 10px;
    }

    .btn-primary {
      background-color: #007bff;
      color: white;
    }

    .btn-danger {
      background-color: #dc3545;
      color: white;
      padding: 6px 14px;
      border-radius: 5px;
      text-decoration: none;
    }

    .btn-danger:hover {
      background-color: #c82333;
    }

    .form_buttons {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }

    @media (max-width: 768px) {
      .form_row {
        flex-direction: column;
        align-items: flex-start;
      }

      .form_row label {
        width: 100%;
      }

      .form_buttons {
        flex-direction: column;
        gap: 10px;
      }
    }
  </style>
</head>

<body>
  <div class="hero_area">
    <?php echo $__env->make('home.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </div>

  <div class="div_deg">
    <div class="cart_container">
      <!-- TABEL PRODUK -->
      <table>
        <tr>
          <th>Nama Produk</th>
          <th>Harga</th>
          <th>Gambar</th>
          <th>Hapus</th>
        </tr>
        <?php $value = 0; ?>
        <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td><?php echo e($cart->product->title); ?></td>
          <td><?php echo e($cart->product->price); ?></td>
          <td><img width="150" src="/products/<?php echo e($cart->product->image); ?>"></td>
          <td><a class="btn-danger" href="<?php echo e(url('delete_cart', $cart->id)); ?>">Hapus</a></td>
        </tr>
        <?php $value += $cart->product->price; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </table>

      <!-- TOTAL -->
      <div class="cart_value">
        Total Harga : Rp.<?php echo e($value); ?>

      </div>

      <!-- FORM PEMESANAN -->
      <div class="order_deg">
        <form action="<?php echo e(url('confirm_order')); ?>" method="POST">
          <?php echo csrf_field(); ?>

          <div class="form_row">
            <label>Nama</label>
            <input type="text" name="name" value="<?php echo e(Auth::user()->name); ?>">
          </div>

          <div class="form_row">
            <label>Alamat</label>
            <textarea name="address"><?php echo e(Auth::user()->address); ?></textarea>
          </div>

          <div class="form_row">
            <label>No.tlpn</label>
            <input type="text" name="phone" value="<?php echo e(Auth::user()->phone); ?>">
          </div>

          <div class="form_row">
            <label>Masukkan Nominal</label>
            <input type="number" name="nominal" required>
          </div>

          <div class="form_buttons">
            <button type="submit" name="payment_method" value="cash on delivery" class="btn btn-secondary">
              Cash On Delivery
            </button>
            <button type="submit" name="payment_method" value="transfer" class="btn btn-primary">
              Bayar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php echo $__env->make('home.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>

</html>
<?php /**PATH E:\Kampung_Jahe_Ecommerce\resources\views/home/mycart.blade.php ENDPATH**/ ?>