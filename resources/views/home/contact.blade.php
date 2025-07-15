<!DOCTYPE html>
<html lang="id">

<head>
  @include('home.css')
  <style>
    .contact_section {
      padding: 60px 0;
    }

    .heading_container h2 {
      text-align: center;
      margin-bottom: 40px;
      font-weight: bold;
    }

    .map_container {
      display: flex;
      justify-content: center;
    }

    .map-responsive {
      overflow: hidden;
      padding-bottom: 56.25%;
      position: relative;
      height: 0;
      width: 100%;
      max-width: 800px;
    }

    .map-responsive iframe {
      left: 0;
      top: 0;
      height: 100%;
      width: 100%;
      position: absolute;
      border-radius: 10px;
      border: 2px solid #ccc;
    }
  </style>
</head>

<body>
  <div class="hero_area">
    @include('home.header')

    <!-- Peta Section -->
    <section class="contact_section">
      <div class="container px-3">
        <div class="heading_container">
          <h2>Lokasi Kampung Jahe Pulesari</h2>
        </div>
        <div class="map_container">
          <div class="map-responsive">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3596.944062250235!2d110.4745876!3d-7.8782341!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5300731f1b15%3A0x6509ba5f9b6ed674!2sTugu%20Kampung%20Jahe%20Pulesari!5e1!3m2!1sid!2sid!4v1746498939843!5m2!1sid!2sid"
              width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
    </section>

    @include('home.footer')
  </div>
</body>

</html>
