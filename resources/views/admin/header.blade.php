<header class="header">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <!-- Panel Pencarian (sembunyi saat default) -->
    <div class="search-panel">
      <div class="search-inner d-flex align-items-center justify-content-center">
        <div class="close-btn text-white">Tutup <i class="fa fa-close"></i></div>
        <form id="searchForm" action="#" class="w-100 px-4">
          <div class="form-group d-flex">
            <input type="search" name="search" class="form-control me-2" placeholder="Cari sesuatu...">
            <button type="submit" class="btn btn-primary">Cari</button>
          </div>
        </form>
      </div>
    </div>

    <div class="container-fluid d-flex align-items-center justify-content-between">
      <!-- Logo -->
      <div class="navbar-header">
        <a href="{{ url('/admin/dashboard') }}" class="navbar-brand text-uppercase">
          <strong class="text-warning">ADMIN</strong>
        </a>
        <!-- Tombol Sidebar -->
        <button class="sidebar-toggle btn text-light"><i class="fa fa-bars"></i></button>
      </div>

      <!-- Logout -->
      <div class="d-flex align-items-center">
        <form method="POST" action="{{ route('logout') }}" class="d-inline-block ms-3">
          @csrf
          <button type="submit" class="btn btn-danger">
            <i class="fa fa-sign-out-alt me-1"></i> Logout
          </button>
        </form>
      </div>
    </div>
  </nav>
</header>
