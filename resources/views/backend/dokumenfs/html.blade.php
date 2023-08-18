<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header bold font-weight-bold h4" id="title-data-opd">
                Dokumen Feasibility Study
            </div>
            <div class="card-body ">
                <button class="btn btn-primary ml-2 mb-2" id="tambah-data">+ Data Dokumen FS</button>
                <table id="table-dokumen-fs" class="table table-stripped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul Kegiatan</th>
                            <th>Pelaksana Kegiatan</th>
                            <th>Lokasi Kegiatan Fs</th>
                            <th>Tahun</th>
                            <th>Dokumen</th>
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
<div class="modal fade" id="modalDokumenFS" tabindex="-1" aria-labelledby="modalDokumenFSLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDokumenFSLabel">

                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="dokumen-fs-form">
                    @csrf
                    <div class="alert alert-danger d-none" id="opd-validation">

                    </div>
                    <div class="form-group">
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                        <input type="text" class="form-control" id="nama_kegiatan" required>
                    </div>
                    <div class="form-group">
                        <label for="opd_id">OPD Pelaksana FS</label>
                        <select class="form-control" id="opd_id" required>
                            <option value="">Pilih OPD ...</option>
                            @foreach ($opd as $opd)
                                <option value="{{ $opd->id }}">{{ $opd->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="opd_id">Lokasi Kegiatan</label>
                        <select class="form-control" id="lokasi_id" required>
                            <option value="">Pilih Lokasi Kegiatan ...</option>
                            @foreach ($lokasi as $loakasi)
                                <option value="{{ $lokasi->id }}">{{ $lokasi->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <select class="form-control" id="tahun" required>
                            <option value="">Pilih tahun ...</option>
                            <?php $tahun = date('Y'); ?>
                            @for ($i = $tahun; $i > $tahun - 10; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tahun">Dokumen</label>
                        <div class="custom-file">
                            <input type="file" id="dokumen" accept="application/pdf" required>
                        </div>
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
