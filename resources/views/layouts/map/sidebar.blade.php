<div id="sidebar" class="sidebar collapsed">
    <!-- Nav tabs -->
    <div class="sidebar-tabs">
        <ul role="tablist">
            <li><a href="#layer-data" role="tab" title="Layer Ali"><i class="fas fa-layer-group"></i></a></li>
            <li><a href="#search" role="tab" title="Pencarian"><i class="fas fa-search"></i></a></li>
            <li><a href="#user" role="tab" title="Profil Pengguna"><i class="fas fa-user"></i></a></li>
            <li><a href="{{ route('dashboard') }}" role="tab" title="Dashboard Admin"><i
                        class="fas fa-computer"></i></a></li>
        </ul>

        <ul role="tablist">
            <li><a href="http://blitarkota.go.id" role="tab"><i class="fa fa-gear"></i></a></li>
        </ul>
    </div>

    <!-- Tab panes -->
    <div class="sidebar-content">
        <div class="sidebar-pane" id="layer-data">
            <h1 class="sidebar-header">
                Layer Ali
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
                    <form id="cari-satuan" method="" class="">
                        <div id="search-ruas" class="">
                            <label for="pencarianRuas" class="mb-2">
                                <h6>Pencarian Lokasi Perencanaan</h6>
                            </label>
                            <select name="pencarianRuas" class="perencanaan" multiple="multiple" id="no-kegiatan"
                                required>
                            </select>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary btn-sm custom"
                                    id="ruas-satuan">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <form method="" class="" id="filter-ruas">
                        {{ csrf_field() }}
                        <label for="">
                            <h6> Pencarian Berdasarkan Realisasi Kegiatan</h6>
                        </label>
                        <div class="">
                            <label for="kecamatan-select">
                                Pilih Kecamatan
                            </label>
                            <select name="kecamatan-select" class="kecamatan" id="kecamatan">
                                <option value="0">--- Pilih Kecamatan ---</option>
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
                        <div class="mt-4">
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
                        </div>
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-sm custom">Cari</button>
                                </div>
                                <div
                                    class="col-7 border rounded rounded-2 d-flex align-items-center justify-content-center bg-light">
                                    <div id="jumlah-ruas" class="h7 fst-italic">Jumlah Ruas : 1507</div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="sidebar-pane" id="user">
            <h1 class="sidebar-header">Profile User<span class="sidebar-close"><i
                        class="fa fa-caret-left"></i></span>
            </h1>
        </div>

        <div class="sidebar-pane" id="back-office">
            <h1 class="sidebar-header">Admin<span class="sidebar-close"><i class="fa fa-caret-left"></i></span></h1>
        </div>
    </div>
</div>
