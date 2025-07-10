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
  
<!-- client section -->
<section class="client_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Testimonial
        </h2>
      </div>
    </div>
    <div class="container px-0">
      <div id="customCarousel2" class="carousel  carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="box">
              <div class="client_info">
                <div class="client_name">
                  <h5>
                  Rina Wijayanti
                  </h5>
                  <h6>
                    Pelanggan
                  </h6>
                </div>
                <i class="fa fa-quote-left" aria-hidden="true"></i>
              </div>
              <p>
              "Jahe Pulesari benar-benar berkualitas! Sejak rutin mengonsumsi, badan terasa lebih fit dan hangat. Terima kasih!"
              </p>
            </div>
          </div>
          <div class="carousel-item">
            <div class="box">
              <div class="client_info">
                <div class="client_name">
                  <h5>
                    Nabila
                  </h5>
                  <h6>
                    Reseller
                  </h6>
                </div>
                <i class="fa fa-quote-left" aria-hidden="true"></i>
              </div>
              <p>
              Produk-produk dari Kampung Jahe Pulesari selalu laris di toko saya. Kualitasnya bagus dan selalu konsisten. Dukungan dari tim mereka juga sangat membantu.
              </p>
            </div>
          </div>
          <div class="carousel-item">
            <div class="box">
              <div class="client_info">
                <div class="client_name">
                  <h5>
                    Tono
                  </h5>
                  <h6>
                    Karyawan Swasta
                  </h6>
                </div>
                <i class="fa fa-quote-left" aria-hidden="true"></i>
              </div>
              <p>
              Biasanya saya minum kopi, tapi sejak coba jahe instan ini, saya jadi ketagihan. Lebih sehat dan bikin tubuh tetap fit walau kerja seharian.
              </p>
            </div>
          </div>
        </div>
        <div class="carousel_btn-box">
          <a class="carousel-control-prev" href="#customCarousel2" role="button" data-slide="prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#customCarousel2" role="button" data-slide="next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- end client section -->






  <!-- info section -->

  <?php echo $__env->make('home.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</body>

</html><?php /**PATH E:\Kampung_Jahe_Ecommerce\resources\views/home/testimonial.blade.php ENDPATH**/ ?>