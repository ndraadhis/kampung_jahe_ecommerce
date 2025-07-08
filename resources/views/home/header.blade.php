<header class="header_section">
  <nav class="navbar navbar-expand-lg custom_nav-container">
    <a class="navbar-brand" href="{{ url('/') }}">
      <span>KAMPUNG JAHE PULESARI</span>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
      <span class=""></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item {{ Request::is('shop') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('shop') }}">Belanja</a>
        </li>
        <li class="nav-item {{ Request::is('why') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('why') }}">Mengapa Kami</a>
        </li>
        <li class="nav-item {{ Request::is('testimonial') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('testimonial') }}">Ulasan</a>
        </li>
        <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('contact') }}">Hubungi Kami</a>
        </li>
      </ul>

      <div class="user_option">
        @if (Route::has('login'))
          @auth
            <a href="{{ url('myorders') }}">Pesanan Saya</a>

            <a href="{{ url('mycart') }}">
              <i class="fa fa-shopping-bag" aria-hidden="true"></i>
              [{{ $count ?? 0 }}]
            </a>

            <form method="POST" action="{{ route('logout') }}" style="padding: 15px; display:inline;">
              @csrf
              <input type="submit" class="btn btn-success" value="Logout">
            </form>
          @else
            <a href="{{ url('/login') }}">
              <i class="fa fa-user" aria-hidden="true"></i>
              <span>Login</span>
            </a>

            <a href="{{ url('/register') }}">
              <i class="fa fa-vcard" aria-hidden="true"></i>
              <span>Register</span>
            </a>
          @endauth
        @endif
      </div>
    </div>
  </nav>
</header>
