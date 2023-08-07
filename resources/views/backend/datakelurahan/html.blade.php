<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header bold font-weight-bold h4" id="title-data-opd">
                Data Kelurahan
            </div>
            <div class="card-body ">
                <button class="btn btn-primary ml-2 mb-2" id="tambah-data">+ Data Kelurahan</button>
                <table id="table-kecamatan" class="table table-stripped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Kelurahan</th>
                            <th>Nama Kecamatan</th>
                            <th>Kode</th>
                            <th>Aksi</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="modalKelurahan" tabindex="-1" aria-labelledby="modalKelurahanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalKelurahanLabel">

            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="kelurahan-form">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama">
                    </div>
                    <div class="form-group">
                        <label for="kode">Kode</label>
                        <textarea name="kode" id="kode" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="kecamatan">Kecamatan</label>
                        <select id="kecamatan" class="form-control">
                          <option selected>Choose...</option>
                          @foreach ($kecamatan as $kec)
                              <option value="{{ $kec->id }}">{{ $kec->nama }}</option>
                          @endforeach
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
