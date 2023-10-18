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

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/55/Lambang_Kota_Blitar.png/450px-Lambang_Kota_Blitar.png"
                    class="img-circle elevation-1 mt-3" alt="User Image">
            </div>

            <div class="info">
                <div class="d-block h7 font-italic mt-0">Badan Perancanaan dan </div>
                <div class="d-block h7 font-italic mb-0">Pembangunan daerah</div>
                <div class="d-block h7 font-italic mb-0">Kota Blitar</div>
            </div>
        </div>
        {{-- </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                @can('Dashboard.Dashboard')
                    <li class="nav-item">
                        <a href="{{ route('dashboard.index') }}" class="nav-link">
                            <i class="fas fa-tachometer-alt nav-icon"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                @endcan
                <li class="nav-header">Menu</li>
                @canany(['Master Data.Data Opd', 'Master Data.Data Kelurahan', 'Master Data.Data Lokasi'])
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Master Data
                                <i class="fas fa-angle-left right"></i>
                                {{-- <span class="badge badge-info right">6</span> --}}
                            </p>
                        </a>
                        <ul class="nav nav-treeview ms-5">
                            @can('Master Data.Data Opd')
                                <li class="nav-item">
                                    <a href="{{ route('data-opd.index') }}" class="nav-link">
                                        <i class="far fa-file nav-icon ml-3"></i>
                                        <p>Data OPD</p>
                                    </a>
                                </li>
                            @endcan
                            @can('Master Data.Data Kelurahan')
                                <li class="nav-item ">
                                    <a href="{{ route('data-kelurahan.index') }}" class="nav-link">
                                        <i class="far fa-file nav-icon ml-3"></i>
                                        <p>Data Kelurahan</p>
                                    </a>
                                </li>
                            @endcan
                            @can('Master Data.Data Lokasi')
                                <li class="nav-item ">
                                    <a href="{{ route('data-lokasi.index') }}" class="nav-link">
                                        <i class="far fa-file nav-icon ml-3"></i>
                                        <p>Data Lokasi</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany([
                    'Data Dokumen.Feasibility Study',
                    'Data Dokumen.Master Plan',
                    'Data Dokumen.Lingkungan',
                    'Data
                    Dokumen.Detail Engineering Design',
                    'Data Dokumen.Dokumen Fisik',
                    ])
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Data Dokumen
                                <i class="fas fa-angle-left right"></i>
                                {{-- <span class="badge badge-info right">6</span> --}}
                            </p>
                        </a>
                        @can('Data Dokumen.Feasibility Study')
                            <ul class="nav nav-treeview ms-5">
                                <li class="nav-item ">
                                    <a href="{{ route('data-dokumen-fs.index') }}" class="nav-link">
                                        <i class="far fa-file nav-icon ml-3"></i>
                                        <p>Dokumen FS</p>
                                    </a>
                                </li>
                            </ul>
                        @endcan
                        @can('Data Dokumen.Master Plan')
                            <ul class="nav nav-treeview ms-5">
                                <li class="nav-item ">
                                    <a href="{{ route('data-dokumen-mp.index') }}" class="nav-link">
                                        <i class="far fa-file nav-icon ml-3"></i>
                                        <p>Dokumen Masterplan</p>
                                    </a>
                                </li>
                            </ul>
                        @endcan
                        @can('Data Dokumen.Lingkungan')
                            <ul class="nav nav-treeview ms-5">
                                <li class="nav-item ">
                                    <a href="{{ route('data-dokumen-lingkungan.index') }}" class="nav-link">
                                        <i class="far fa-file nav-icon ml-3"></i>
                                        <p>Dokumen Lingkungan</p>
                                    </a>
                                </li>
                            </ul>
                        @endcan
                        @can('Data Dokumen.Detail Engineering Design')
                            <ul class="nav nav-treeview ms-5">
                                <li class="nav-item ">
                                    <a href="{{ route('data-dokumen-ded.index') }}" class="nav-link">
                                        <i class="far fa-file nav-icon ml-3"></i>
                                        <p>Dokumen DED</p>
                                    </a>
                                </li>
                            </ul>
                        @endcan
                        @can('Data Dokumen.Dokumen Fisik')
                            <ul class="nav nav-treeview ms-5">
                                <li class="nav-item ">
                                    <a href="{{ route('data-dokumen-fisik.index') }}" class="nav-link">
                                        <i class="far fa-file nav-icon ml-3"></i>
                                        <p>Dokumen Fisik</p>
                                    </a>
                                </li>
                            </ul>
                        @endcan
                    </li>
                @endcanany
                @canany([
                    'Data Pendukung.Kawasan Kumuh',
                    'Data Pendukung.Kawasan RTLH',
                    'Data Pendukung.Lokus
                    Kemiskinan',
                    'Data Pendukung.Lokus Stunting',
                    'Data Pendukung.Jaringan Spam',
                    ])
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Data Pendukung
                                <i class="fas fa-angle-left right"></i>
                                {{-- <span class="badge badge-info right">6</span> --}}
                            </p>
                        </a>
                        <ul class="nav nav-treeview ms-5">
                            @can('Data Pendukung.Kawasan Kumuh')
                                <li class="nav-item">
                                    <a href="{{ route('data-kawasan-kumuh.index') }}" class="nav-link">
                                        <i class="far fa-file nav-icon ml-3"></i>
                                        <p>Kawasan Kumuh</p>
                                    </a>
                                </li>
                            @endcan
                            @can('Data Pendukung.Kawasan RTLH')
                                <li class="nav-item">
                                    <a href="{{ route('data-kawasan-rtlh.index') }}" class="nav-link">
                                        <i class="far fa-file nav-icon ml-3"></i>
                                        <p>Data RTLH</p>
                                    </a>
                                </li>
                            @endcan
                            @can('Data Pendukung.Lokus Kemiskinan')
                                <li class="nav-item">
                                    <a href="{{ route('data-lokus-kemiskinan.index') }}" class="nav-link">
                                        <i class="far fa-file nav-icon ml-3"></i>
                                        <p>Data Kemiskinan</p>
                                    </a>
                                </li>
                            @endcan
                            @can('Data Pendukung.Lokus Stunting')
                                <li class="nav-item">
                                    <a href="{{ route('data-lokus-stunting.index') }}" class="nav-link">
                                        <i class="far fa-file nav-icon ml-3"></i>
                                        <p>Lokus Stunting</p>
                                    </a>
                                </li>
                            @endcan
                            @can('Data Pendukung.Jaringan Spam')
                                <li class="nav-item">
                                    <a href="{{ route('data-lokasi-spam.index') }}" class="nav-link">
                                        <i class="far fa-file nav-icon ml-3"></i>
                                        <p>Lokasi SPAM</p>
                                    </a>
                                </li>
                            @endcan
                            <li class="nav-item">
                                <a href="{{ route('data-lokasi-ipal.index') }}" class="nav-link">
                                    <i class="far fa-file nav-icon ml-3"></i>
                                    <p>Lokasi IPAL</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('data-jaringan-pipa-pdam.index') }}" class="nav-link">
                                    <i class="far fa-file nav-icon ml-3"></i>
                                    <p>Jaringan Pipa PDAM</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('data-lokasi-sumur-pdam.index') }}" class="nav-link">
                                    <i class="far fa-file nav-icon ml-3"></i>
                                    <p>Lokasi Sumur PDAM</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcanany

                @canany(['Administrator.Hak Akses', 'Administrator.Data User'])
                    <li class="nav-header">Administrator</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-users-cog nav-icon "></i>
                            <p>
                                Administrator
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ms-5">
                            @can('Administrator.Hak Akses')
                                <li class="nav-item ">
                                    <a href="{{ route('admin-role.index') }}" class="nav-link">
                                        <i class="fas fa-user-tag nav-icon ml-3"></i>
                                        <p>Hak Akses</p>
                                    </a>
                                </li>
                            @endcan
                            @can('Administrator.Data User')
                                <li class="nav-item ">
                                    <a href="/admin/user" class="nav-link">
                                        <i class="fas fa-users nav-icon ml-3"></i>
                                        <p>Data User</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                <li class="nav-header">KDR With Love</li>
            </ul>
        </nav>
    </div>
    </div>
</aside>
