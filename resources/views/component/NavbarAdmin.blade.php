        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                   <i class="fa-solid fa-user-tie"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Halaman Admin <sup>*</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{route('admin')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Kelola Data
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Kelola Data</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{route('admin.datakasir')}}">Data Kasir</a>
                        <a class="collapse-item" href="{{route('admin.databarang')}}">Data Produk</a>
                        <a class="collapse-item" href="{{route('admin.jenispembayaran')}}">Data Jenis Pembayaran</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

             <!-- Nav Item - transaksi -->
             <li class="nav-item active">
                <a class="nav-link" href="{{route('admin.create.histori')}}">
                   <i class="fa-solid fa-cart-shopping"></i>
                    <span>Tambah Transaksi</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider"> 

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link text-center" href="/logout"><b>Logout</b></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->