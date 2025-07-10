<!DOCTYPE html>
<html>

<head>
 <?php echo $__env->make('home.css', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <?php echo $__env->make('home.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <!-- end header section -->
    <!-- slider section -->
    <?php echo $__env->make('home.slider', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- end slider section -->
  </div>
  <!-- end hero area -->

  <!-- shop section -->
  <?php echo $__env->make('home.product', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <!-- end shop section -->









   

  <!-- info section -->

  <?php echo $__env->make('home.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</body>

</html><?php /**PATH E:\Kampung_Jahe_Ecommerce\resources\views/home/index.blade.php ENDPATH**/ ?>