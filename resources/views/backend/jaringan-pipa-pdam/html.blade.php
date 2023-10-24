<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header bold font-weight-bold h4" id="">
                Data Jaringan Pipa PDAM
            </div>
            <div class="card-body">
                <div class="row p-1">

                    <div class="col-md-8">
                        <div id="modal-map" class="border" style="height: 600px"></div>
                    </div>

                    <div class="col-md-4 border p-3">
                        <div class="">
                            <div class="form-group">
                                <div class="border border-danger bg-warning p-3 mt-1">
                                    <span class="h6">Pastikan file yang diupload memiliki ekstensi
                                        <strong>.geojson</strong></span>
                                </div>
                            </div>
                            <form id="pipa-pdam-form">
                                @csrf
                                <input type="hidden" id="name_file" value="{{ $jaringan_pipa_pdam }}">
                                <div class="form-group">
                                    <label for="file-jaringan-pipa-pdam">Upload File Geometry</label>
                                    <div class="custom-file">
                                        <input type="file" id="file-jaringan-pipa-pdam" accept=".geojson" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col p-1 d-none" id="btn-container-submit-map">
                                        <input type="submit" class="btn btn-primary w-100" value="Simpan Perubahan">
                                    </div>
                                    <div class="col p-1 d-none" id="btn-container-cancel-map">
                                        <button type="button" class="btn btn-secondary w-100"
                                            id="cancel-change-map">Batal</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>

</section>
