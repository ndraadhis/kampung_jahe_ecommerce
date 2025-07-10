<!DOCTYPE html>
<html>
  <head> 
   <?php echo $__env->make('admin.css', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
   <style type="text/css">
    table{
        border : 2px solid skyblue;
        text-align : center;
    }
    th{
        background-color : skyblue;
        padding: 10px;
        font-size 18px;
        font-weight: bold;
        text-align: center;
    }
    td{
        color:white;
        padding: 10px;
        border:1px solid skyblue;
    }
    .table_center{
        display: flex;
        justify-content :center;
        align-items: center;
    }
   </style>
  </head>
  <body>
   
   <?php echo $__env->make('admin.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

   <?php echo $__env->make('admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

          <div class="table_center">

       <table>
        <tr>
            <th>Nama Pelanggan</th>
            <th>Alamat</th>
            <th>No.tlpn</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Gambar</th>
            <th>Status Pembayaran</th>
            <th>Status</th>
            <th>Ubah Status</th>
            <th>Print PDF</th>
        </tr>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($data->name); ?></td>
            <td><?php echo e($data->rec_address); ?></td>
            <td><?php echo e($data->phone); ?></td>
            <td><?php echo e($data->product->title); ?></td>
            <td><?php echo e($data->product->price); ?></td>
            <td>
                <img width= "150" src="products/<?php echo e($data->product->image); ?>">
            </td>


            <td><?php echo e($data->payment_status); ?></td>
            <td>
                <?php if($data->status =='in progress'): ?>

                <span style="color:red"><?php echo e($data->status); ?></span>

                <?php elseif($data->status =='On the way'): ?>

                <span style="color:skyblue;"><?php echo e($data->status); ?></span>
                <?php else: ?>
                <span style="color:yellow;"><?php echo e($data->status); ?></span>

                <?php endif; ?>
            </td>
            <td>
                <a class="btn btn-primary" href="<?php echo e(url('on_the_way', $data->id)); ?>">On the way</a>
                <a class="btn btn-success" href="<?php echo e(url('delivered', $data->id)); ?>">Delivered</a>
            </td>
            <td>
            <a class="btn btn-secondary" href="<?php echo e(url('print_pdf', $data->id)); ?>">Print PDF</a>
         </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
        </div>
          </div>   
      </div>
    </div>
    <!-- JavaScript files-->
    <?php echo $__env->make('admin.js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </body>
</html><?php /**PATH E:\Kampung_Jahe_Ecommerce\resources\views/admin/order.blade.php ENDPATH**/ ?>