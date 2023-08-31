<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('map.index') }}" class="nav-link">Peta &nbsp<i class="fa fa-globe-asia"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        {{-- navbar admin --}}
        <li class="nav-item dropdown user-menu">

            {{-- User menu toggler --}}
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                @php $avatar = Auth::user()->avatar @endphp
                <img src="{{ asset("assets/image/avatar/$avatar") }}"
                    class="user-image img-circle img-thumbnail elevation-2 avatar-navbar" alt="ADMIN">
                <span class="d-none d-md-inline">
                    {{-- {{ Auth::user()->name }} --}}
                </span>
            </a>

            {{-- User menu dropdown --}}
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                {{-- User menu header --}}

                <li class="user-header h-auto">
                    <img src="{{ asset("assets/image/avatar/$avatar") }}" class="img-circle img-thumbnail elevation-2 avatar-navbar"
                        alt="ADMIN">

                    <p class=" mt-0"> {{ Auth::user()->username }} <small>{{ Auth::user()->name }}</small>
                    </p>
                </li>


                {{-- User menu body --}}
                {{-- @hasSection('usermenu_body') --}}
                {{-- <li class="user-body">
                    SASA
                </li> --}}
                {{-- @endif --}}

                {{-- User menu footer --}}
                <li class="user-footer">
                    <button id="profile-edit-modal" class="btn btn-default btn-flat float-right btn-block">
                        <i class="fa fa-fw fa-user text-lightblue"></i>
                        Edit Profil
                    </button>
                    <a class="btn btn-default btn-flat float-right btn-block" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-fw fa-power-off text-red"></i>
                        Keluar
                    </a>
                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                        {{-- @if (config('adminlte.logout_method'))
                            {{ method_field(config('adminlte.logout_method')) }}
                        @endif --}}
                        {{ csrf_field() }}
                    </form>
                </li>

            </ul>

        </li>
    </ul>
</nav>
<!-- /.navbar -->


{{-- Profile Edit Modal --}}
<div class="modal fade" id="profileEditModal" tabindex="-1" aria-labelledby="profileEditModalLabel"
    aria-hidden="true" style="z-index: 2001;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="profileEditModalLabel">Edit Profile</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
            <div class="modal-body">
                <form id="form-edit-profile">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="mb-3">
                                <label for="avatar" class="form-label" style="cursor: pointer;">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <img id="avatar-sidebar-edit" src="assets/image/avatar/{{ Auth::user()->avatar }}" class="img my-3 rounded rounded-circle" width="150" height="150" alt="">
                                    </div>
                                    <input type="file" id="avatar" class="form-control form-control-sm" hidden>
                                <span style="font-size: 10px; font-style: italic;" class="d-block">*klik untuk merubah gambar</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="mb-1">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" id="name" class="form-control form-control-sm">
                            </div>
                            <div class="mb-1">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" id="username" class="form-control form-control-sm">
                            </div>
                            <div class="mb-1">
                                <label for="password" class="form-label">Perbarui Password</label>
                                <input type="password" id="password" class="form-control form-control-sm" placeholder="Masukkan password baru ...">
                                <span style="font-size: 10px; font-style: italic;">*kosongkan isian jika tidak ingin merubah password</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
