 <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">


        @if (auth()->user()->role=='admin')
            <li class="nav-item">
                <a href="/{{ auth()->user()->role }}/dashboard" class="nav-link {{Request::is('admin/dashboard')?'active':''}}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        Home
                    </p>
                </a>
            </li>
       
            <li class="nav-item">
                <a href="/{{ auth()->user()->role }}/galerifoto" class="nav-link {{Request::is('admin/galerifoto')?'active':''}}">
                    <i class="nav-icon far fa-images"></i>
                    <p>
                        Galeri Foto
                    </p>
                </a>
            </li>

              <li class="nav-item">
              <a href="{{ route('paketfoto.admin') }}" class="nav-link {{Request::is('admin/paketfoto')?'active':''}}">
                  <i class="nav-icon fas fa-archive"></i>
                  <p>Paket Foto</p>
                </a>
              </li>
            <li class="nav-item">
                <a href="/{{ auth()->user()->role }}/pemesanan" class="nav-link {{Request::is('admin/pemesanan')?'active':''}}">
                    <i class="nav-icon fas fa-credit-card"></i>
                    <p>
                        Pemesanan
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/{{ auth()->user()->role }}/cetakfoto" class="nav-link {{Request::is('admin/cetakfoto')?'active':''}}">
                    <i class="nav-icon fas fa-archive"></i>
                    <p>Cetak Foto</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/{{ auth()->user()->role }}/detailcetakfoto" class="nav-link {{Request::is('admin/detailcetakfoto')?'active':''}}">
                    <i class="nav-icon fas fa-credit-card"></i>
                    <p>
                       Detail Cetak Foto
                    </p>
                </a>
            </li>
            </ul>
            </li>
          
            {{-- <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>
                        Logout
                    </p>
                </a>
            </li> --}}
        @else

        <li class="nav-item">
            <a href="/{{ auth()->user()->role }}/dashboard" class="nav-link {{Request::is('user/dashboard')?'active':''}}">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Home
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="/{{ auth()->user()->role }}/galerifoto" class="nav-link {{Request::is('user/galerifoto')?'active':''}}">
                <i class="nav-icon far fa-images"></i>
                <p>
                    Galeri Foto
                </p>
            </a>
        </li>

        <li class="nav-item">
                <a href="/{{ auth()->user()->role }}/cart" class="nav-link {{Request::is('user/cart')?'active':''}}">
                    <i class="nav-icon fas fa-shopping-cart"></i>
                    <p>
                        Cart
                    </p>
                </a>
            </li>

              <li class="nav-item">
              <a href="{{ route('paketfoto.user') }}" class="nav-link {{Request::is('user/paketfoto')?'active':''}}">
                  <i class="nav-icon fas fa-archive"></i>
                  <p>Paket Foto</p>
                </a>
              </li>
             
        <li class="nav-item">
            <a href="/{{ auth()->user()->role }}/pemesanan" class="nav-link {{Request::is('user/pemesanan')?'active':''}}">
                <i class="nav-icon fas fa-credit-card"></i>
                <p>
                    Pemesanan
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/{{ auth()->user()->role }}/cetakfoto" class="nav-link {{Request::is('user/cetakfoto')?'active':''}}">
                <i class="nav-icon fas fa-archive"></i>
                <p>
                   Cetak Foto
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/{{ auth()->user()->role }}/detailcetakfoto" class="nav-link {{Request::is('user/detailcetakfoto')?'active':''}}">
                <i class="nav-icon fas fa-credit-card"></i>
                <p>
                    Detail Cetak Foto
                </p>
            </a>
        </li>
        </ul>
        </li>
        
        {{-- <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    Logout
                </p>
            </a>
        </li> --}}
        @endif

    </ul>
</nav>