<!DOCTYPE html>
<html>
<head> 
  <?php echo $__env->make('admin.css', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <style type="text/css">
    input[type='text'] {
      width: 400px;
      height: 50px;
    }

    .form-kanan {
      display: flex;
      justify-content: flex-end;
      margin: 30px 0;
    }

    .form-kanan form {
      display: flex;
      gap: 10px;
    }

    .form-kanan input[type="text"] {
      width: 300px;
      height: 40px;
    }

    .table_deg {
      text-align: center;
      margin: 0 auto;
      border: 2px solid yellowgreen;
      width: 600px;
    }

    th {
      background-color: skyblue;
      padding: 15px;
      font-size: 20px;
      font-weight: bold;
      color: white;
    }

    td {
      color: white;
      padding: 10px;
      border: 1px solid skyblue;
    }
  </style>
</head>
<body>

  <?php echo $__env->make('admin.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <?php echo $__env->make('admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <div class="page-content">
    <div class="page-header">
      <div class="container-fluid">
        <h1 style="color:white; text-align: center;">Tambah Kategori Produk</h1>

        <!-- Form Tambah Kategori di Kanan -->
        <div class="form-kanan">
          <form action="<?php echo e(url('add_category')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="text" name="category" placeholder="Nama kategori..." required>
            <input class="btn btn-primary" type="submit" value="Tambah Kategori">
          </form>
        </div>

        <!-- Tabel Daftar Kategori -->
        <table class="table_deg">
          <tr>
            <th>Nama Kategori</th>
            <th>Edit</th>
            <th>Hapus</th>
          </tr>
          <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($data->category_name); ?></td>
            <td>
              <a class="btn btn-success" href="<?php echo e(url('edit_category', $data->id)); ?>">Edit</a>
            </td>
            <td>
              <a class="btn btn-danger" onclick="confirmation(event)" href="<?php echo e(url('delete_category', $data->id)); ?>">Hapus</a>
            </td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>

      </div>
    </div>
  </div>

  <?php echo $__env->make('admin.js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</body>
</html>
<?php /**PATH E:\Kampung_Jahe_Ecommerce\resources\views/admin/category.blade.php ENDPATH**/ ?>