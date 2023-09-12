<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header bold font-weight-bold h4" id="title-data-opd">
                Data Kawasan Kumuh
            </div>
            <div class="card-body ">
                <button class="btn btn-primary ml-2 mb-2" id="tambah-data">+ Data Kawasan Kumuh</button>
                <table id="table-kawasankumuh" class="table table-stripped">
                    <thead>
                        <tr>
                            <th style="width:2%;">#</th>
                            <th>Nama Kelurahan</th>
                            <th>Nama Kecamatan</th>
                            <th style="width: 5%;">Skoring</th>
                            <th>Tingkat Kekumuhan</th>
                            <th>Luas (Ha)</th>
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
    <div class="modal fade" id="modalKawasanKumuh" tabindex="-1" aria-labelledby="modalKawasanKumuhLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKawasanKumuhLabel">

                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="kawasankumuh-form">
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
                            <label for="jumlah">Skoring</label>
                            <input type="number" class="form-control" id="jumlah">
                        </div>
                        <div class="form-group">
                            <label for="tingkat-kumuh">Kondisi</label>
                            <select name="" class="form-control" id="tingkat-kumuh">
                                <option>Kumuh Sangat Ringan</option>
                                <option>Kumuh Ringan</option>
                                <option>Kumuh Menengah</option>
                                <option>Sangat Kumuh</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="luas">Luasan</label>
                            <input type="number" step="0.01" class="form-control" id="luas">
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
