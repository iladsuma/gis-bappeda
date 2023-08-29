<section class="content">
    <div class="container-fluid">

        <!-- Small boxes (Stat box) -->
        <div class="card">
            <div class="card-header bold font-weight-bold h4" id="title-dashboard">
                Dashboard
            </div>
            {{-- <div class="card-body ">
                <form method="" action="" id="filter-chart">
                    {{ csrf_field() }}
                    <div class="mb-3 mt-0">
                        <i class="fas fa-search mr-2"></i>
                        <select class="js-example-basic-single " name="kecamatan" id="list-kecamatan">
                            <option value="0"> SEMUA KECAMATAN </option>
                        </select>

                        <select class="js-example-basic-single " name="kelurahan" id="list-kelurahan" disabled hidden>
                            <option value="0"> SEMUA KELURAHAN </option>
                        </select>

                        <button class="btn btn-primary btn-sm ml-3">Cari</button>
                </form>
            </div> --}}
            <div class="row m-3">
                <div class="col-4">
                    {{-- <div class="col-lg-3 col-6"> --}}
                    <!-- small box -->
                    <div class="card">
                        <div class="card-body" id="container-box">
                            <div>
                                <div class="small-box bg-success px-3">
                                    <div class="inner">
                                        <h4 class="font-weight-bold" id="lokasi">
                                            {{ $jumlah_lokasi }}
                                        </h4>
                                        <h6 class="font-weight-bold">
                                            Data Lokasi
                                        </h6>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                </div>
                                <!-- ./col -->
                                {{-- <div class="col-lg-3 col-6"> --}}
                                <!-- small box -->
                                <div class="small-box px-3" style="background: #fff000">
                                    <div class="inner text-light">
                                        <h4 class="font-weight-bold" id="fs">
                                            {{ $jumlah_dokumen_fs }}
                                        </h4>
                                        <h6 class="font-weight-bold">
                                            Dokumen FS
                                        </h6>
                                    </div>
                                    <div class="icon">
                                        <i class="far fa-file"></i>
                                    </div>
                                </div>
                                {{-- </div> --}}
                                <!-- ./col -->
                                {{-- <div class="col-lg-3 col-6"> --}}
                                <!-- small box -->
                                <div class="small-box px-3" style="background: #185678">
                                    <div class="inner text-light">
                                        <h4 class="font-weight-bold" id="mp">
                                            {{ $jumlah_dokumen_mp }}
                                        </h4>
                                        <h6 class="font-weight-bold">
                                            Dokumen MP
                                        </h6>
                                    </div>
                                    <div class="icon">
                                        <i class="far fa-file"></i>
                                    </div>
                                </div>
                                {{-- </div> --}}
                                <!-- ./col -->
                                {{-- <div class="col-lg-3 col-6"> --}}
                                <!-- small box -->
                                <div class="small-box px-3" style="background: #ACCE53">
                                    <div class="inner text-light">
                                        <h4 class="font-weight-bold" id="lingkungan">
                                            {{ $jumlah_dokumen_lingkungan }}
                                        </h4>
                                        <h6 class="font-weight-bold">
                                            Dokumen Lingkungan
                                        </h6>
                                    </div>
                                    <div class="icon">
                                        <i class="far fa-file"></i>
                                    </div>
                                </div>

                                <div class="small-box px-3" style="background: #5e3e4e">
                                    <div class="inner text-light">
                                        <h4 class="font-weight-bold" id="ded">
                                            {{ $jumlah_dokumen_ded }}
                                        </h4>
                                        <h6 class="font-weight-bold">
                                            Dokumen DED
                                        </h6>
                                    </div>
                                    <div class="icon">
                                        <i class="far fa-file"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                {{-- </div> --}}
                <div class="col-8">
                    <div class="card">
                        <div class="card-body" id="container-chart">
                            <canvas id="dokumen-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.row -->
    <!-- Main row -->
    <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
