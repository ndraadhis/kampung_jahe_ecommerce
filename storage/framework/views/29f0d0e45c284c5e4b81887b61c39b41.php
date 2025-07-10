<section class="shop_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>Produk Terbaru</h2>
    </div>

    
    <div class="d-flex justify-content-end mb-4">
      <form action="<?php echo e(route('shop.searchCategory')); ?>" method="GET" class="d-flex" style="max-width: 400px;">
            <input type="text" name="category" placeholder="Cari berdasarkan kategori..." required class="form-control me-2">
          <button type="submit" class="btn btn-success">Cari</button>
      </form>
    </div>

    
    <?php if(isset($keyword)): ?>
      <div class="text-center mb-3">
        <p>Hasil pencarian untuk kategori: <strong><?php echo e($keyword); ?></strong></p>
        <a href="<?php echo e(route('shop.index')); ?>" class="btn btn-secondary">Tampilkan Semua Produk</a>
      </div>
    <?php endif; ?>

    <div class="row">
      <?php $__empty_1 = true; $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <div class="img-box">
              <img src="products/<?php echo e($products->image); ?>" alt="<?php echo e($products->title); ?>">
            </div>
            <div class="detail-box">
              <h6><?php echo e($products->title); ?></h6>
              <h6>Harga
                <span><?php echo e(($products->price)); ?></span>
              </h6>
            </div>
            <div style="padding: 15px">
              <a class="btn btn-danger" href="<?php echo e(url('product_details', $products->id)); ?>">Detail</a>
              <a class="btn btn-primary" href="<?php echo e(url('add_cart', $products->id)); ?>">Tambahkan</a>
            </div>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12 text-center">
          <p>Tidak ada produk ditemukan untuk kategori tersebut.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php /**PATH E:\Kampung_Jahe_Ecommerce\resources\views/home/product.blade.php ENDPATH**/ ?>