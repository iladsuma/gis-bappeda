<section class="content">
    <div class="container-fluid">

        <!-- Small boxes (Stat box) -->
        <div class="card">
            <div class="card-header bold font-weight-bold h4" id="title-lokus-stunting">
                Data Lokus Stunting
            </div>
            <div class="card-body ">
                <button class="btn btn-primary ml-2 mb-2" id="tambah-data">+ Data Lokus Stunting</button>
                <table id="table-lokus-stunting" class="table table-stripped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Kelurahan</th>
                            <th>Nama Kecamatan</th>
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
    <div class="modal fade" id="modalLokusStunting" tabindex="-1" aria-labelledby="modalLokusStuntingLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLokusStuntingLabel">

                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="lokus-stunting-form">
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
                        {{-- <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah">
                        </div> --}}
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
