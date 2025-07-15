<header class="header_section">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
  

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
              aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Menu Navigasi -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('/') ? 'active text-warning' : ''); ?>" href="<?php echo e(url('/')); ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('shop') ? 'active text-warning' : ''); ?>" href="<?php echo e(url('shop')); ?>">Belanja</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('why') ? 'active text-warning' : ''); ?>" href="<?php echo e(url('why')); ?>">Mengapa Kami</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('testimonial') ? 'active text-warning' : ''); ?>" href="<?php echo e(url('testimonial')); ?>">Ulasan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo e(Request::is('contact') ? 'active text-warning' : ''); ?>" href="<?php echo e(url('contact')); ?>">Lokasi</a>
          </li>
        </ul>

        <!-- User Option -->
        <div class="d-flex align-items-center">
          <?php if(Route::has('login')): ?>
            <?php if(auth()->guard()->check()): ?>
              <a href="<?php echo e(url('myorders')); ?>" class="btn btn-outline-light me-2">
                <i class="fa fa-list"></i> Pesanan
              </a>

              <a href="<?php echo e(url('mycart')); ?>" class="btn btn-outline-warning me-3 position-relative">
                <i class="fa fa-shopping-bag"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  <?php echo e($count ?? 0); ?>

                </span>
              </a>

              <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-success">Logout</button>
              </form>
            <?php else: ?>
              <a href="<?php echo e(url('/login')); ?>" class="btn btn-outline-light me-2">
                <i class="fa fa-user"></i> Login
              </a>
              <a href="<?php echo e(url('/register')); ?>" class="btn btn-outline-warning">
                <i class="fa fa-vcard"></i> Daftar
              </a>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>
</header>
<?php /**PATH E:\Kampung_Jahe_Ecommerce\resources\views/home/header.blade.php ENDPATH**/ ?>