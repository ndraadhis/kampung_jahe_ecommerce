<!DOCTYPE html>
<html>

<head>
 @include('home.css')
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
    <!-- slider section -->
  
    <section class="contact_section ">
    <div class="container px-0">
      <div class="heading_container ">
      <h2 class="" style="margin-top: 50px;">PETA KAMI</h2>
      </div>
    </div>
    <div class="container container-bg">
      <div class="row">
        <div class="col-lg-7 col-md-6 px-0">
          <div class="map_container">
            <div class="map-responsive">
              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3596.944062250235!2d110.4745876!3d-7.8782341!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5300731f1b15%3A0x6509ba5f9b6ed674!2sTugu%20Kampung%20Jahe%20Pulesari!5e1!3m2!1sid!2sid!4v1746498939843!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-5 px-0">
          <form action="#">
            <div>
              <input type="text" placeholder="Name" />
            </div>
            <div>
              <input type="email" placeholder="Email" />
            </div>
            <div>
              <input type="text" placeholder="Phone" />
            </div>
            <div>
              <input type="text" class="message-box" placeholder="Message" />
            </div>
            <div class="d-flex ">
              <button>
                SEND
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>



   

  <!-- info section -->

  @include('home.footer')

</body>

</html>