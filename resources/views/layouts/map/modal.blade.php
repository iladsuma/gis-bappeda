<section>
    <div class="modal fade" id="modal-detail" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detail-title">Detail Perencanaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class=" nav-link detail-tab active" role="tab" data-bs-target="#fs"
                                data-bs-toggle="tab" aria-current="page" href="javascript:void(0)" id="fs-tab"
                                data-id="">Feasibility
                                Study</a>
                        </li>
                        <li class="nav-item">
                            <a class=" nav-link detail-tab" role="tab" data-bs-target="#mp" data-bs-toggle="tab"
                                href="javascript:void(0)" id="mp-tab" data-id="">Master
                                Plan</a>
                        </li>
                        <li class="nav-item">
                            <a class=" nav-link detail-tab" role="tab" data-bs-target="#lingkungan"
                                data-bs-toggle="tab" href="javascript:void(0)" id="lingkungan-tab"
                                data-id="">Lingkungan</a>
                        </li>
                        <li class="nav-item">
                            <a class=" nav-link detail-tab" role="tab" data-bs-target="#ded" data-bs-toggle="tab"
                                href="javascript:void(0)" id="ded-tab" data-id="">Detail
                                Enginering Design</a>
                        </li>
                        <li class="nav-item">
                            <a class=" nav-link detail-tab" role="tab" data-bs-target="#fisik" data-bs-toggle="tab"
                                href="javascript:void(0)" id="fisik-tab" data-id="">Realisasi
                                Fisik</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" role='tab-panel' id="fs">
                            <div class="mt-3">
                                <table class="table table-sm table-striped" id="table-fs" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 2%">#</th>
                                            <th>Judul Dokumen</th>
                                            <th>Pelaksana Kegiatan</th>
                                            <th>Tahun Kegiatan</th>
                                            <th>Dokumen Kegiatan</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" role='tab-panel' id="mp">
                            <div class="mt-3">
                                <table class="table table-sm table-striped" id="table-mp" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 2%">#</th>
                                            <th>Judul Dokumen</th>
                                            <th>Pelaksana Kegiatan</th>
                                            <th>Tahun Kegiatan</th>
                                            <th>Dokumen Kegiatan</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" role='tab-panel' id="lingkungan">
                            <hr>
                            <div class="mt-3">
                                <table class="table table-striped" id="table-lingkungan" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 2%">#</th>
                                            <th>Judul Dokumen</th>
                                            <th>Pelaksana Kegiatan</th>
                                            <th>Tahun Kegiatan</th>
                                            <th>Dokumen Kegiatan</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" role='tab-panel' id="ded">
                            <hr>
                            <div class="mt-3">
                                <table class="table table-stripped" id="table-ded" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 2%">#</th>
                                            <th>Judul Kegiatan</th>
                                            <th>Pelaksana Kegiatan</th>
                                            <th>Tahun Kegiatan</th>
                                            <th>Dokumen Kegiatan</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" role='tab-panel' id="fisik">
                            <br>
                            <br>
                            <br>
                            Realisasi Fisik
                            <br>
                            <br>
                            <br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="popup" id="popup" hidden>
            <img class="img-fluid" id="foto-popup" src="">
            <table class="table table-bordered">
                <tr>
                    <th>Nama</th>
                    <th>:</th>
                    <th id="nama-popup">Tes</th>
                </tr>
                <tr>
                    <th>Kecamatan</th>
                    <th>:</th>
                    <th id="kecamatan-popup">Sananwetan</th>
                </tr>
                <tr>
                    <th>Kelurahan</th>
                    <th>:</th>
                    <th id="kelurahan-popup">Bendogerit</th>
                </tr>
            </table>
        </div>
</section>

<div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-dialog-location">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="locationModalLabel">Daftar Lokasi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="table-location" class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th class="text-center">#</th>
                            <th class="text-center">Nama Lokasi</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center document ">FS</th>
                            <th class="text-center document">MP</th>
                            <th class="text-center document">Lingkungan</th>
                            <th class="text-center document">DED</th>
                            <th class="text-center document">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
        </div>
    </div>
</div>
