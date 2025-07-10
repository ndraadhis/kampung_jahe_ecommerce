<header class="header_section">
  <nav class="navbar navbar-expand-lg custom_nav-container">
    <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
      <span>KAMPUNG JAHE PULESARI</span>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
      <span class=""></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item <?php echo e(Request::is('/') ? 'active' : ''); ?>">
          <a class="nav-link" href="<?php echo e(url('/')); ?>">Home</a>
        </li>
        <li class="nav-item <?php echo e(Request::is('shop') ? 'active' : ''); ?>">
          <a class="nav-link" href="<?php echo e(url('shop')); ?>">Belanja</a>
        </li>
        <li class="nav-item <?php echo e(Request::is('why') ? 'active' : ''); ?>">
          <a class="nav-link" href="<?php echo e(url('why')); ?>">Mengapa Kami</a>
        </li>
        <li class="nav-item <?php echo e(Request::is('testimonial') ? 'active' : ''); ?>">
          <a class="nav-link" href="<?php echo e(url('testimonial')); ?>">Ulasan</a>
        </li>
        <li class="nav-item <?php echo e(Request::is('contact') ? 'active' : ''); ?>">
          <a class="nav-link" href="<?php echo e(url('contact')); ?>">Hubungi Kami</a>
        </li>
      </ul>

      <div class="user_option">
        <?php if(Route::has('login')): ?>
          <?php if(auth()->guard()->check()): ?>
            <a href="<?php echo e(url('myorders')); ?>">Pesanan Saya</a>

            <a href="<?php echo e(url('mycart')); ?>">
              <i class="fa fa-shopping-bag" aria-hidden="true"></i>
              [<?php echo e($count ?? 0); ?>]
            </a>

            <form method="POST" action="<?php echo e(route('logout')); ?>" style="padding: 15px; display:inline;">
              <?php echo csrf_field(); ?>
              <input type="submit" class="btn btn-success" value="Logout">
            </form>
          <?php else: ?>
            <a href="<?php echo e(url('/login')); ?>">
              <i class="fa fa-user" aria-hidden="true"></i>
              <span>Login</span>
            </a>

            <a href="<?php echo e(url('/register')); ?>">
              <i class="fa fa-vcard" aria-hidden="true"></i>
              <span>Register</span>
            </a>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
  </nav>
</header>
<?php /**PATH E:\Kampung_Jahe_Ecommerce\resources\views/home/header.blade.php ENDPATH**/ ?>