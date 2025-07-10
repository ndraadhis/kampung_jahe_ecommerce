<!DOCTYPE html>
<html>
  <head> 
   <?php echo $__env->make('admin.css', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<style type="text/css">
    .div_deg{
        display: flex;
        justify-content: center;
        align-items:center;
    }
    label{
        display: inline-block;
        width: 200px;
        padding: 20px;
    }
    input[type='text']{
        width: 300px;
        height: 60px;
    }
    textarea{
        width: 400px;
        height: 80px;
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

          <h2>Update Produk</h2>
          <div class="div_deg">
          <form action="<?php echo e(url('/edit_product', $data->id)); ?>" method="POST" enctype="multipart/form-data">

            <?php echo csrf_field(); ?>
                <div>
                    <label>Nama Produk</label>
                    <input type="text" name="title" value="<?php echo e($data->title); ?>">
                </div>
                <div>
                    <label>Deskripsi Produk</label>
                   <textarea name="description"><?php echo e($data->description); ?></textarea>
                </div>
                <div>
                    <label>Harga</label>
                    <input type="text" name="price" value="<?php echo e($data->price); ?>">
                </div>
                <div>
                    <label>Jumlah Produk</label>
                    <input type="number" name="quantity" value="<?php echo e($data->quantity); ?>">
                </div>
                <div>
                    <label>Category</label>
                    <select name="category">
                        <option value="<?php echo e($data->category); ?>"><?php echo e($data->category); ?></option>
                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->category_name); ?>"><?php echo e($category->category_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>
                </div>
                <div>
                    <label>Current Image</label>
                    <img width="150" src="/products/<?php echo e($data->image); ?>">
                </div>
                <div>
                    <label>New Image</label>
                    <input type="file" name="image">
                </div>
                <div>
                    <input class="btn btn-success" type="submit" value="Update Product">
                    
                </div>
            </form>
          </div>
          </div>   
      </div>
    </div>
    <!-- JavaScript files-->
   <?php echo $__env->make('admin.js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </body>
</html><?php /**PATH E:\Kampung_Jahe_Ecommerce\resources\views/admin/update_page.blade.php ENDPATH**/ ?>