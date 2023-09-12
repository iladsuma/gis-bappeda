<section class="content">
    <div class="container-fluid">

        <!-- Small boxes (Stat box) -->
        <div class="card">
            <div class="card-header bold font-weight-bold h4" id="title-rtlh">
                Data RTLH
            </div>
            <div class="card-body ">
                <button class="btn btn-primary ml-2 mb-2" id="tambah-data">+ Data RTLH</button>
                <table id="table-kawasan-rtlh" class="table table-stripped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Kelurahan</th>
                            <th>Nama Kecamatan</th>
                            <th>Jumlah RTLH</th>
                            <th>Jumlah Penanganan</th>
                            <th>Tahun</th>
                            <th>Aksi</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalKawasanRtlh" tabindex="-1" aria-labelledby="modalKawasanRtlhLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKawasanRtlhLabel">

                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="kawasan-rtlh-form">
                        @csrf
                        <div class="form-group">
                            <label for="kelurahan">Kelurahan</label>
                            <select class="form-control" id="kelurahan">
                                <option selected>Pilih kelurahan ...</option>
                                @foreach ($data_kelurahan as $kelurahan)
                                    <option value="{{ $kelurahan->id }}">{{ $kelurahan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah RTLH</label>
                            <input type="number" class="form-control" id="jumlah">
                        </div>
                        <div class="form-group">
                            <label for="penanganan">Jumlah Penanganan</label>
                            <input type="number" class="form-control" id="penanganan">
                        </div>
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <select name="" class="form-control" id="tahun">
                                @for ($year = date('Y') - 5; $year <= date('Y') + 5; $year++)
                                    <option>{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
