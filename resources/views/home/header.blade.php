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
            <a class="nav-link {{ Request::is('/') ? 'active text-warning' : '' }}" href="{{ url('/') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('shop') ? 'active text-warning' : '' }}" href="{{ url('shop') }}">Belanja</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('why') ? 'active text-warning' : '' }}" href="{{ url('why') }}">Mengapa Kami</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('testimonial') ? 'active text-warning' : '' }}" href="{{ url('testimonial') }}">Ulasan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('contact') ? 'active text-warning' : '' }}" href="{{ url('contact') }}">Lokasi</a>
          </li>
        </ul>

        <!-- User Option -->
        <div class="d-flex align-items-center">
          @if (Route::has('login'))
            @auth
              <a href="{{ url('myorders') }}" class="btn btn-outline-light me-2">
                <i class="fa fa-list"></i> Pesanan
              </a>

              <a href="{{ url('mycart') }}" class="btn btn-outline-warning me-3 position-relative">
                <i class="fa fa-shopping-bag"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  {{ $count ?? 0 }}
                </span>
              </a>

              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-success">Logout</button>
              </form>
            @else
              <a href="{{ url('/login') }}" class="btn btn-outline-light me-2">
                <i class="fa fa-user"></i> Login
              </a>
              <a href="{{ url('/register') }}" class="btn btn-outline-warning">
                <i class="fa fa-vcard"></i> Daftar
              </a>
            @endauth
          @endif
        </div>
      </div>
    </div>
  </nav>
</header>
