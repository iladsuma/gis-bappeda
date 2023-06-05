<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    {{-- <a href="#" class="brand-link">
        <div class="row">
            <div class="col-sm-2">
                <img src="{{ asset('assets/image/logo/logo-kab.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-rounded " style="opacity: .8">
            </div>
            <div class="col-sm-4">
                <p class="brand-text font-weight-light">Dinas Perumahan dan Kawasan Permukiman </p>
            </div>
        </div>
    </a> --}}

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 ">
            {{-- @php
                $avatar = Auth::user()->avatar;
            @endphp --}}
            <div class="row">
                <div class="col-2 ml-0">
                    {{-- <div class="image"> --}}
                    <img src="{{ asset('assets/image/logo/logo-kab.png') }}" class="img-rounded mt-1" alt="User Image">
                    {{-- </div> --}}
                </div>
                <div class="col-10 ">
                    <a class="d-block h7 font-italic mt-0">Dinas Perumahan Rakyat dan</a>
                    <a class="d-block h7 font-italic mb-0">Kawasan Permukiman</a>
                </div>
            </div>
            {{-- <div class="info">
            </div> --}}
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                {{-- @canany(['Data Wilayah.Index', 'Ruas Jalan.Index', 'Data Pemeliharaan.Index']) --}}
                <li class="nav-header">Data Tables</li>
                <li class="nav-item">
                    {{-- @can('Data Wilayah.Index') --}}
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Data Wilayah
                            <i class="fas fa-angle-left right"></i>
                            {{-- <span class="badge badge-info right">6</span> --}}
                        </p>
                    </a>
                    {{-- @endcan --}}
                    <ul class="nav nav-treeview ms-5">
                        {{-- @can('Data Wilayah.Kecamatan') --}}
                        <li class="nav-item ">
                            <a href="/data/kecamatan" class="nav-link">
                                <i class="far fa-file nav-icon ml-3"></i>
                                <p>Kecamatan</p>
                            </a>
                        </li>
                        {{-- @endcan --}}
                        {{-- @can('Data Wilayah.Kelurahan') --}}
                        <li class="nav-item">
                            <a href="/data/kelurahan" class="nav-link">
                                <i class="far fa-file nav-icon ml-3"></i>
                                <p>Kelurahan</p>
                            </a>
                        </li>
                        {{-- @endcan --}}
                    </ul>
                </li>
                <li class="nav-item">
                    {{-- @can('Ruas Jalan.Index') --}}
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Ruas Jalan
                            <i class="fas fa-angle-left right"></i>
                            {{-- <span class="badge badge-info right">6</span> --}}
                        </p>
                    </a>
                    {{-- @endcan --}}
                    <ul class="nav nav-treeview ms-5">
                        {{-- @can('Ruas Jalan.Kelurahan') --}}
                        <li class="nav-item ">
                            <a href="/ruas/kelurahan" class="nav-link">
                                <i class="far fa-file nav-icon ml-3"></i>
                                <p>Kelurahan</p>
                            </a>
                        </li>
                        {{-- @endcan --}}
                        {{-- <li class="nav-item">
                            <a href="/ruas/desa" class="nav-link">
                                <i class="far fa-file nav-icon ml-3"></i>
                                <p>Desa</p>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                <li class="nav-item">
                    {{-- @can('Data Pemeliharaan.Index') --}}
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Data Pemeliharaan
                            <i class="fas fa-angle-left right"></i>
                            {{-- <span class="badge badge-info right">6</span> --}}
                        </p>
                    </a>
                    {{-- @endcan --}}
                    <ul class="nav nav-treeview ms-5">
                        {{-- @can('Data Pemeliharaan.Penyedia Jasa') --}}
                        <li class="nav-item">
                            <a href="/data/penyediajasa" class="nav-link">
                                <i class="far fa-file nav-icon ml-3"></i>
                                <p>Penyedia Jasa</p>
                            </a>
                        </li>
                        {{-- @endcan --}}
                        {{-- @can('Data Pemeliharaan.Riwayat Pemeliharaan') --}}
                        <li class="nav-item ">
                            <a href="/data/pemeliharaan" class="nav-link">
                                <i class="far fa-file nav-icon ml-3"></i>
                                <p>Riwayat Pemeliharaan</p>
                            </a>
                        </li>
                        {{-- @endcan --}}
                    </ul>
                </li>
                {{-- @endcanany --}}
                {{-- @canany(['Administrator.Index']) --}}
                <li class="nav-header">Administrator</li>
                <li class="nav-item">
                    {{-- @can('Administrator.Index') --}}
                    <a href="#" class="nav-link">
                        <i class="fas fa-users-cog nav-icon "></i>
                        <p>
                            Administrator
                            <i class="fas fa-angle-left right"></i>
                            {{-- <span class="badge badge-info right">6</span> --}}
                        </p>
                    </a>
                    {{-- @endcan --}}
                    <ul class="nav nav-treeview ms-5">
                        {{-- @can('Administrator.Hak Akses') --}}
                        <li class="nav-item ">
                            <a href="/admin/role" class="nav-link">
                                <i class="fas fa-user-tag nav-icon ml-3"></i>
                                <p>Hak Akses</p>
                            </a>
                        </li>
                        {{-- @endcan --}}
                        {{-- @can('Administrator.Data User') --}}
                        <li class="nav-item ">
                            <a href="/admin/user" class="nav-link">
                                <i class="fas fa-users nav-icon ml-3"></i>
                                <p>Data User</p>
                            </a>
                        </li>
                        {{-- @endcan --}}
                        {{-- @can('Administrator.Setting')
                                <li class="nav-item">
                                    <a href="admin/setting" class="nav-link">
                                        <i class="fas fa-cog nav-icon ml-3"></i>
                                        <p>Setting</p>
                                    </a>
                                </li>
                            @endcan --}}
                    </ul>
                </li>
                {{-- @endcanany --}}
                <li class="nav-header">KDR With Love</li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
