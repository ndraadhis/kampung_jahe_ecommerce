<!DOCTYPE html>
<html>

<head>
 <?php echo $__env->make('home.css', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
 <style type="text/css">
    .div_center
    {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 30px;
    }
    .detail-box{
        padding: 15px;
    }
    </style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <?php echo $__env->make('home.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <!-- end header section -->
    
  </div>

 <!-- produk detail -->
  <section class="shop_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        PRODUK TERBARU
      </h2>
    </div>
    <div class="row">
     
        <div class="col-md-12">
          <div class="box">
            
              <div class="div_center">
                <img width="400" src="/products/<?php echo e($data->image); ?>" alt="">
              </div>


              <div class="detail-box">
                <h6><?php echo e($data->title); ?></h6>
                <h6>Harga
                  <span><?php echo e($data->price); ?></span>
                </h6>
              </div>
            
              <div class="detail-box">
                <h6>Kategori: <?php echo e($data->category); ?></h6>

                <h6>Produk Tersedia
                  <span><?php echo e($data->quantity); ?></span>
                </h6>
              </div>

              <div class="detail-box">
                  <p><?php echo e($data->description); ?></p>
              </div>

          </div>
        </div>
     
    </div>
  </div>
</section>

 <!-- produk akhir -->
 
   

  <!-- info section -->

  <?php echo $__env->make('home.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</body>

</html><?php /**PATH E:\Kampung_Jahe_Ecommerce\resources\views/home/product_details.blade.php ENDPATH**/ ?>