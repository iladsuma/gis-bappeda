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
                    class="user-image img-circle img-thumbnail elevation-2" alt="ADMIN">
                <span class="d-none d-md-inline">
                    {{-- {{ Auth::user()->name }} --}}
                </span>
            </a>

            {{-- User menu dropdown --}}
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                {{-- User menu header --}}

                <li class="user-header h-auto">
                    <img src="{{ asset("assets/image/avatar/$avatar") }}" class="img-circle img-thumbnail elevation-2"
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
                    <button id="edit-profile" class="btn btn-default btn-flat float-right btn-block" data-toggle="modal"
                        data-target="#modal-profile">
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

{{-- profile modal --}}

<div class="modal fade" id="modal-profile" tabindex="-1" aria-labelledby="modal-edit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="self-edit" action="" method=""
                oninput="selfPassword2.setCustomValidity(selfPassword2.value != selfPassword.value ? 'Passwords do not match.' : '')">
                {{ csrf_field() }}
                <div class="modal-header">
                    {{-- <h5 class="modal-title" id="modal-title">{{ Auth::user()->name }} - Profil</h5> --}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @php
                        // $avatar = Auth::user()->avatar;
                    @endphp
                    <div class="mx-auto d-block">
                        {{-- <label for="foto-user" class="col-sm-4 col-form-label">FOTO PENGGUNA</label> --}}
                        <label for="self-image" class="mx-auto d-block">
                            <a title="Foto Ruas">
                                {{-- <img id="self-foto" src="{{ asset("assets/image/avatar/$avatar") }}" alt="Ruas"
                                    class="rounded-circle img-thumbnail mx-auto d-block"
                                    style="cursor:pointer; height: 150px; width: 150px"> --}}
                            </a>
                        </label>
                        <p class="text-center" style="font-style: italic; font-size: 12px">
                            *klik untuk merubah foto</p>
                        <input id="self-image" type="file" style="display: none;"
                            accept="image/png, image/jpg, image/jpeg" />
                    </div>
                    <div class="form-group row">
                        <label for="self-name" class="col-sm-4 col-form-label">NAMA LENGKAP</label>
                        <div class="col-sm-8">
                            {{-- <input type="hidden" class="form-control" name="id-user" id="id-user"
                                value="{{ Auth::user()->id }}" required>
                            <input type="text" class="form-control" name="self-name" id="self-name"
                                value="{{ Auth::user()->name }}" required> --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="self-username" class="col-sm-4 col-form-label">NAMA PENGGUNA</label>
                        <div class="col-sm-8">
                            {{-- <input type="text" class="form-control" name="self-username" id="self-username"
                                value="{{ Auth::user()->username }}" required> --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="self-password" class="col-sm-4 col-form-label">KATA SANDI</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="selfPassword" id="self-password-1"
                                value="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="self-password-2" class="col-sm-4 col-form-label">VERIFIKASI KATA SANDI</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="selfPassword2" id="self-password-2"
                                value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" id="self-simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
