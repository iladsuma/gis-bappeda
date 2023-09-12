<section class="content">
    <div class="container-fluid">

        <!-- Small boxes (Stat box) -->
        <div class="card">
            <div class="card-header bold font-weight-bold h4" id="title-lokus-kemiskinan">
                Data Lokus Kemiskinan
            </div>
            <div class="card-body ">
                <button class="btn btn-primary ml-2 mb-2" id="tambah-data">+ Data Lokus Kemiskinan</button>
                <table id="table-lokus-kemiskinan" class="table table-stripped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Kelurahan</th>
                            <th>Nama Kecamatan</th>
                            <th>Jumlah Kemiskinan</th>
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
    <div class="modal fade" id="modalLokusKemiskinan" tabindex="-1" aria-labelledby="modalLokusKemiskinanLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLokusKemiskinanLabel">

                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="lokus-kemiskinan-form">
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
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah">
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
