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
                <table id="table-location" class="table table-bordered table-striped" style="width:100%">
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
        </div>
    </div>
</div>

{{-- Profile Edit Modal --}}
<div class="modal fade" id="profileEditModal" tabindex="-1" aria-labelledby="profileEditModalLabel"
    aria-hidden="true" style="z-index: 2001;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="profileEditModalLabel">Edit Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-edit-profile">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="mb-3">
                                <label for="avatar" class="form-label" style="cursor: pointer;">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <img id="avatar-sidebar-modal" src="assets/image/avatar/{{ Auth::user()->avatar }}" class="img my-3 rounded rounded-circle" width="150" height="150" alt="">
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
