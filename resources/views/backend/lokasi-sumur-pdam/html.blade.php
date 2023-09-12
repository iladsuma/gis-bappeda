<section class="content">
    <div class="container-fluid">

        <!-- Small boxes (Stat box) -->
        <div class="card">
            <div class="card-header bold font-weight-bold h4" id="title-dataspampdam">
                Data Lokasi Sumur PDAM
            </div>
            <div class="card-body ">
                <button class="btn btn-primary ml-2 mb-2" id="tambah-data">+ Data Spam</button>
                <table id="table-sumur-pdam" class="table table-stripped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama </th>
                            <th>Alamat</th>
                            <th>Kelurahan</th>
                            <th>Kecamatan</th>
                            <th>aksi</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-lokasi-spam" tabindex="-1" aria-labelledby="modal-lokasi-kegiatan"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">
                        Tambah Data Spam
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="lokasi-spam-form">
                        @csrf
                        <div class="row p-2">
                            <div class="col-md-4 border p-3">
                                <div class="alert alert-danger d-none" id="lokasi-validation">

                                </div>
                                <div class="form-group">
                                    <label for="nama-lokasi">Nama Spam</label>
                                    <input type="text" class="form-control form-control-sm" id="nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="" class="form-control form-control-sm" id="alamat" cols="3" rows="2"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="kelurahan">Kelurahan</label>
                                    <select name="" class="form-control form-control-sm" id="kelurahan">
                                        <option value="">Pilih Kelurahan ...</option>
                                        @foreach ($kelurahan as $kelurahan)
                                            <option value="{{ $kelurahan->id }}">{{ $kelurahan->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="koordinat">Koordinat</label>
                                    {{-- <textarea class="form-control form-control-sm" id="koordinat" cols="3" rows="2"></textarea> --}}
                                    <input type="text" class="form-control form-control-sm" id="koordinat">
                                </div>
                                <div class="form-group">
                                    <label for="foto-lokasi">Foto Lokasi</label>
                                    <div class="custom-file">
                                        <input type="file" id="foto-lokasi"
                                            accept="image/png, image/jpg, image/jpeg">
                                    </div>
                                </div>
                                {{-- <div class="text-center">
                                    <img id="foto-preview" src="#" class="border p-2 align-center"
                                        style="height: 100px; width: 150px" alt="preview" hidden />
                                </div> --}}
                                {{-- <div class="form-group">
                                    <div class="border border-danger bg-warning p-3 mt-5">
                                        <span class="h6">Pastikan Lokasi belum ada di database sebelum anda
                                            memasukkan data lokasi
                                            baru</span>
                                    </div>
                                </div> --}}
                                <div class="form-group">
                                    <label for="tahun">Tahun</label>
                                    <select name="" class="form-control" id="tahun">
                                        @for ($year = date('Y') - 15; $year <= date('Y'); $year++)
                                            <option>{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="terpasang">Terpasang</label>
                                    <input type="number" class="form-control" id="terpasang">
                                </div>
                                <div class="form-group">
                                    <label for="terpasang">Aktif</label>
                                    <input type="number" class="form-control" id="aktif">
                                </div>
                            </div>
                            <div class="col-md-8 p-4">
                                <div id="modal-map" class="border" style="height: 600px"></div>
                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="dismiss">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
