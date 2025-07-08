<div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="{{asset('admincss/img/indraadhis.JPG')}}" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">INDRA ADHI SAPUTRA</h1>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Menu Utama</span>
        <ul class="list-unstyled">
                <li ><a href="{{url('admin/dashboard')}}"> <i class="icon-home"></i>Home </a></li>
                <li><a href="{{url('view_category')}}"> <i class="icon-grid"></i>Kategori </a></li>

                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Produk</a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="{{url('add_product')}}">Tambah Produk</a></li>
                    <li><a href="{{url('view_product')}}">Lihat Produk</a></li>
                  </ul>
                </li>
                <li><a href="{{url('view_orders')}}"> <i class="icon-grid"></i>Order</a></li>

               
        </ul>
      </nav>