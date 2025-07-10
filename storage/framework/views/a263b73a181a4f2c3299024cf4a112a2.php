<!DOCTYPE html>
<html>
  <head> 
   <?php echo $__env->make('admin.css', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


<style type="text/css">
    .div_deg
    {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 60px;
    }
    input[type='text']
    {
        width: 400px;
        height: 50px;
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

          <h1 style="color:white;">Perbarui Produk</h1>

         <div class="div_deg">
           
            <form action="<?php echo e(url('update_category',$data->id)); ?>" method="post">
                <?php echo csrf_field(); ?>
                <input type="text" name="category" value="<?php echo e($data->category_name); ?>">
                <input class="btn btn-primary" type="submit" value="Perbarui Kategori">
            </form>
        </div>
          </div>   
      </div>
    </div>
    <!-- JavaScript files-->
    <?php echo $__env->make('admin.js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </body>
</html><?php /**PATH E:\Kampung_Jahe_Ecommerce\resources\views/admin/edit_category.blade.php ENDPATH**/ ?>