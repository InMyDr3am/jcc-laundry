<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
        <img src="{{ asset('layout-admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">LaundryKu</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('layout-admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->nama }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
                {{-- <li class="nav-item">
        <a href="/" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
            Dashboard
            </p>
        </a>
        </li> --}}

                @if (auth()->user()->role_user_id == 1)
                    <li class="nav-item">
                        <a href="/role_user" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Data Role User
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/user" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Data User
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="/jenis_cuci" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Data Jenis Cuci
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/penyucian" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Data Pesanan Cucian
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        Pendapatan
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/pendapatan" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pendapatan Per Tanggal</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/pendapatan-today" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pendapatan Hari Ini</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item bg-danger">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
