<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header bold font-weight-bold h4" id="">
                Data Jaringan Pipa PDAM
            </div>
            <div class="card-body ">
                    <div class="row p-2">

                        <div class="col-md-8 p-4">
                            <div id="modal-map" class="border" style="height: 600px"></div>
                        </div>


                        <div class="col-md-4 border p-3">
                            <form id="pipa-pdam-form">
                                @csrf
                                <input type="hidden" id="name_file" value="{{ $jaringan_pipa_pdam }}">
                                <div class="form-group">
                                    <label for="file-jaringan-pipa-pdam">Upload File Geometry</label>
                                    <div class="custom-file">
                                        <input type="file" id="file-jaringan-pipa-pdam" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Upload">
                                </div>
                            </form>
                            <div class="form-group">
                                <div class="border border-danger bg-warning p-3 mt-5">
                                    <span class="h6">Pastikan file yang diupload dengan ekstensi <strong>.geojson</strong></span>
                                </div>
                            </div>
                        </div>

                    </div>
            </div>
        </div>
    </div>
    </div>

</section>
