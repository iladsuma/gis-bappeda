<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header bold font-weight-bold h4" id="title-data-opd">
                Dokumen Detail Enginer Design
            </div>
            <div class="card-body ">
                <button class="btn btn-primary ml-2 mb-2" id="tambah-data">+ Data Dokumen Detail Enginer Design</button>
                <table id="table-dokumen-ded" class="table table-stripped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul Kegiatan</th>
                            <th>Pelaksana Kegiatan</th>
                            <th>Lokasi Kegiatan Ded</th>
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

    {{-- Dokumen Preview Modal --}}
    <div class="modal fade" id="documentPreviewModal" tabindex="-1" aria-labelledby="documentPreviewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="documentPreviewModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe src="" id="iframeDocumentPreview" height="500" width="100%"
                        title="Iframe Example"></iframe>
                </div>
            </div>
        </div>
    </div>

</section>

<!-- Modal -->
<div class="modal fade" id="modalDokumenDed" tabindex="-1" aria-labelledby="modalDokumenDedLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDokumenDedLabel">

                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="dokumen-ded-form">
                    @csrf
                    <div class="alert alert-danger d-none" id="dokumen-mp-validation">

                    </div>
                    <div class="form-group">
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                        <input type="text" class="form-control form-control-sm" id="nama_kegiatan" required>
                    </div>
                    <div class="form-group">
                        <label for="opd_id">OPD</label>
                        <select class="form-control form-control-sm" id="opd_id" required>
                            <option value="">Pilih OPD ...</option>
                            @foreach ($opd as $opd)
                                <option value="{{ $opd->id }}">{{ $opd->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="opd_id">Lokasi Kegiatan</label>
                        <select class="form-control form-control-sm" id="lokasi_id" multiple required>
                            {{-- <option value="">Pilih Lokasi Kegiatan ...</option> --}}
                            @foreach ($lokasi as $lokasi)
                                <option value="{{ $lokasi->id }}">{{ $lokasi->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <select class="form-control form-control-sm" id="tahun" required>
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
