<style>
  .info_section {
    background-color: #2c2c2c;
    color: #fff;
    padding: 40px 0 20px;
  }

  .info_section h6 {
    color: #fff;
    font-weight: 700;
    margin-bottom: 15px;
  }

  .info_section p,
  .info_section span {
    font-size: 15px;
    color: #ddd;
  }

  .social_container {
    text-align: center;
    margin-bottom: 20px;
  }

  .social_box a {
    color: #fff;
    margin: 0 10px;
    font-size: 20px;
    display: inline-block;
  }

  .info_container .container {
    max-width: 1140px;
    margin: auto;
  }

  .info_link-box a {
    display: block;
    margin-bottom: 10px;
    color: #fff;
    text-decoration: none;
  }

  .footer_section {
    background: #1f1f1f;
    text-align: center;
    padding: 20px 0;
    font-size: 14px;
    color: #aaa;
  }

  @media (max-width: 768px) {
    .info_container .row {
      text-align: center;
    }
  }
</style>

<section class="info_section layout_padding2-top">
  <!-- Social Media -->
  <div class="social_container">
    <div class="social_box">
      <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
      <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
      <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
      <a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a>
    </div>
  </div>

  <!-- Info Section -->
  <div class="info_container">
    <div class="container">
      <div class="row justify-content-center text-center">
        <!-- ABOUT US -->
        <div class="col-md-6 col-lg-3 mb-4">
          <h6>ABOUT US</h6>
          <p>
            Kampung Jahe Pulesari adalah merek terpercaya yang menghadirkan produk olahan jahe berkualitas tinggi. Kami berkomitmen untuk menyediakan produk herbal alami yang mendukung gaya hidup sehat. Dengan bahan baku jahe terbaik, setiap produk kami dirancang untuk memberikan manfaat kesehatan optimal bagi Anda.
          </p>
        </div>

        <!-- NEED HELP -->
        <div class="col-md-6 col-lg-3 mb-4">
          <h6>NEED HELP</h6>
          <p>
            Hubungi kami melalui email atau telepon untuk pertanyaan atau bantuan lebih lanjut.
          </p>
        </div>

        <!-- CONTACT US -->
        <div class="col-md-6 col-lg-3 mb-4">
          <h6>CONTACT US</h6>
          <div class="info_link-box">
            <a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i>
              <span>Pugeran, RT.3/RW.5, Semoyo, Kec. Patuk, Gunungkidul, DIY</span></a>
            <a href="#"><i class="fa fa-phone" aria-hidden="true"></i>
              <span>+6282324150634</span></a>
            <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>
              <span>indraadhis22@gmail.com</span></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer_section">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span> All Rights Reserved By 
        <a href="#">Kampung Jahe Pulesari</a>
      </p>
    </div>
  </footer>
</section>

<script>
  // Display current year
  document.getElementById("displayYear").textContent = new Date().getFullYear();
</script>
<?php /**PATH E:\Kampung_Jahe_Ecommerce\resources\views/home/footer.blade.php ENDPATH**/ ?>