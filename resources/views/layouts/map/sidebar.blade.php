<div id="sidebar" class="sidebar collapsed">
    <!-- Nav tabs -->
    <div class="sidebar-tabs">
        <ul role="tablist">
            <li><a href="#layer-data" role="tab" title="Layer Data"><i class="fas fa-layer-group"></i></a></li>
            <li><a href="#search" role="tab" title="Pencarian"><i class="fas fa-search"></i></a></li>
            <li><a href="#user" role="tab" title="Profil Pengguna"><i class="fas fa-user"></i></a></li>
            <li><a href="{{ route('dashboard.index') }}" role="tab" title="Dashboard Admin"><i
                        class="fas fa-computer"></i></a></li>
            <li style="cursor: pointer"><a data-bs-toggle="modal" data-bs-target="#locationModal" id="location-modal"><i
                        class="fa-solid fa-table-list"></i></a></li>
        </ul>

        <ul role="tablist">
            <li><a href="http://blitarkota.go.id" role="tab"><i class="fa fa-gear"></i></a></li>
        </ul>
    </div>

    <!-- Tab panes -->
    <div class="sidebar-content">
        <div class="sidebar-pane" id="layer-data">
            <h1 class="sidebar-header">
                Layer Data
                <span class="sidebar-close"><i class="fa fa-caret-left"></i></span>
            </h1>
            <div class="leaflet-control-layers">
                <label class="leaflet-control-layers-group-name ml-2 mb-0">Peta Dasar</label>
            </div>
        </div>

        <div class="sidebar-pane" id="search">
            <h1 class="sidebar-header">Pencarian Dokumen<span class="sidebar-close"><i
                        class="fa fa-caret-left"></i></span></h1>
            <div class="card mt-2">
                <div class="card-body">
                    <form id="cari-lokasi" method="" class="">
                        <div id="search-ruas" class="">
                            <label for="pencarianRuas" class="mb-2">
                                <h6>Pencarian Lokasi Perencanaan</h6>
                            </label>
                            <select name="pencarianRuas" class="perencanaan" multiple="multiple" id="lokasi-select"
                                required>
                                @foreach ($data_lokasi as $lokasi)
                                    <option value="{{ $lokasi->id }}">{{ $lokasi->nama }}</option>
                                @endforeach
                            </select>
                            <div class="mt-3">
                                <button type="submit" class="btn button-submit btn-primary btn-sm custom"
                                    id="button-submit">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <form method="" class="" id="lokasi-administrasi">
                        {{ csrf_field() }}
                        <label for="">
                            <h6> Pencarian Berdasarkan Wilayah Administrasi</h6>
                        </label>
                        <div class="">
                            <label for="kecamatan-select">
                                Pilih Kecamatan
                            </label>
                            <select name="kecamatan-select" class="kecamatan" id="kecamatan">
                                <option value="0">--- Pilih Kecamatan ---</option>
                                @foreach ($kecamatan as $kec)
                                    <option value="{{ $kec->id }}">{{ $kec->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-2">
                            <label for="kecamatan-select">
                                Pilih Kelurahan
                            </label>
                            <select name="kelurahan-select" class="kelurahan" id="kelurahan" disabled>
                                <option value="0">--- Pilih Kelurahan ---</option>
                            </select>
                        </div>
                        {{-- <div class="mt-4">
                            <label for="kecamatan-select">
                                Kondisi Jalan
                            </label>
                            <div class="row mt-2" id="kondisi-cek">
                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="realisasi" type="radio" value="1"
                                            id="baik" checked>
                                        <label class="form-check-label" for="baik">
                                            Sudah Terbangun
                                        </label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="realisasi" type="radio" value="2"
                                            id="sedang">
                                        <label class="form-check-label" for="sedang">
                                            Belum Terbangun
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-sm custom">Cari</button>
                                </div>
                                {{-- <div
                                    class="col-7 border rounded rounded-2 d-flex align-items-center justify-content-center bg-light">
                                    <div id="jumlah-ruas" class="h7 fst-italic">Jumlah Lokasi : 0</div>
                                </div> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="sidebar-pane" id="user">
            <h1 class="sidebar-header">Profile User<span class="sidebar-close"><i class="fa fa-caret-left"></i></span>
            </h1>
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-10 d-flex justify-content-center">
                            <img id="avatar-sidebar" src="assets/image/avatar/{{ Auth::user()->avatar }}"
                                class="img my-3 rounded rounded-circle" width="250" height="250" alt="">
                        </div>
                    </div>
                    <h3 class="text-center fw-bold">{{ Auth::user()->name }}</h3>
                    <h5 class="text-center fw-bold">{{ Auth::user()->username }}</h5>
                    <div class="row mt-5 mb-5">
                        <div class="col-lg-6 px-3">
                            <button class="btn btn-success btn-sm w-100 fw-bold" id="profile-edit-modal"><i
                                    class="fas fa-user-cog"></i> Edit Profile</button>
                        </div>
                        <div class="col-lg-6 px-3">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="btn btn-danger btn-sm w-100 fw-bold"
                                    type="submit" onclick="event.preventDefault(); this.closest('form').submit();"><i
                                        class="fas fa-sign-out-alt"></i> Keluar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sidebar-pane" id="back-office">
            <h1 class="sidebar-header">Admin<span class="sidebar-close"><i class="fa fa-caret-left"></i></span></h1>
        </div>
    </div>
</div>
