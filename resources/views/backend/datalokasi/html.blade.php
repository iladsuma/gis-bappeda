<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header bold font-weight-bold h4" id="title-data-opd">
                Data Lokasi
            </div>
            <div class="card-body ">
                <button class="btn btn-primary ml-2 mb-2" id="tambah-data">+ Data Lokasi</button>
                <table id="table-data-lokasi" class="table table-stripped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Lokasi</th>
                            <th>Kelurahan</th>
                            <th>Kecamatan</th>
                            <th>Alamat</th>
                            <th>Foto Lokasi</th>
                            <th>Aksi</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-lokasi-kegiatan" tabindex="-1" aria-labelledby="modal-lokasi-kegiatan"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">
                        Tambah Data Lokasi
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="lokasi-kegiatan-form">
                    <div class="modal-body">
                        @csrf
                        <div class="row p-2">
                            <div class="col-md-4 border p-3">
                                <div class="alert alert-danger d-none" id="lokasi-validation">

                                </div>
                                <div class="form-group">
                                    <label for="nama-lokasi">Nama Lokasi Kegiatan</label>
                                    <input type="text" class="form-control" id="nama-lokasi" required>
                                </div>
                                <div class="form-group">
                                    <label for="kelurahan">Kelurahan</label>
                                    <select name="" class="form-control" id="kelurahan">
                                        <option value="">Pilih Kelurahan ...</option>
                                        @foreach ($kelurahan as $kelurahan)
                                            <option value="{{ $kelurahan->id }}">{{ $kelurahan->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="" class="form-control" id="alamat" cols="3" rows="2"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="koordinat">Koordinat</label>
                                    <textarea class="form-control" id="koordinat" cols="3" rows="2"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="foto-lokasi">Foto Lokasi</label>
                                    <div class="custom-file">
                                        <input type="file" id="foto-lokasi"
                                            accept="image/png, image/jpg, image/jpeg">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <img id="foto-preview" src="#" class="border p-2 align-center"
                                        style="height: 100px; width: 150px" alt="preview" hidden />
                                </div>
                                <div class="form-group">
                                    <div class="border border-danger bg-warning p-3 mt-5">
                                        <span class="h6">Pastikan Lokasi belum ada di database sebelum anda
                                            memasukkan data lokasi
                                            baru</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 p-4">
                                <div id="modal-map" class="border" style="height: 600px"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            id="dismiss">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
