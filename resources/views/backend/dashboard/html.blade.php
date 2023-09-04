<section class="content">
    <div class="container-fluid">

        <!-- Small boxes (Stat box) -->
        <div class="card">
            <div class="card-header bold font-weight-bold h4" id="title-dashboard">
                Dashboard
            </div>
            <div class="card-body ">
                {{-- <form method="" action="" id="filter-chart">
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
                </form> --}}

                <div class="row m-3">
                    <div class="col-4">
                        {{-- <div class="col-lg-3 col-6"> --}}
                        <!-- small box -->
                        <div class="card">
                            <div class="card-body" id="container-box">
                                <div>
                                    <div class="small-box px-3" style="background:  #47B39C">
                                        <div class="inner text-light">
                                            <h3 class="font-weight-bold" id="lokasi">
                                                {{ $jumlah_lokasi }}
                                            </h3>
                                            <p>Data Lokasi</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    {{-- <div class="col-lg-3 col-6"> --}}
                                    <!-- small box -->
                                    <div class="small-box px-3" style="background: #00529B">
                                        <div class="inner text-light">
                                            <h3 class="font-weight-bold" id="fs">
                                                {{ $jumlah_dokumen_fs }}
                                            </h3>
                                            <p>
                                                Dokumen FS
                                            </p>
                                        </div>
                                        <div class="icon">
                                            <i class="far fa-file"></i>
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                    <!-- ./col -->
                                    {{-- <div class="col-lg-3 col-6"> --}}
                                    <!-- small box -->
                                    <div class="small-box px-3" style="background: #007CC3">
                                        <div class="inner text-light">
                                            <h3 class="font-weight-bold" id="mp">
                                                {{ $jumlah_dokumen_mp }}
                                            </h3>
                                            <p>
                                                Dokumen MP
                                            </p>
                                        </div>
                                        <div class="icon">
                                            <i class="far fa-file"></i>
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                    <!-- ./col -->
                                    {{-- <div class="col-lg-3 col-6"> --}}
                                    <!-- small box -->
                                    <div class="small-box px-3" style="background: #7AC142">
                                        <div class="inner text-light">
                                            <h3 class="font-weight-bold" id="lingkungan">
                                                {{ $jumlah_dokumen_lingkungan }}
                                            </h3>
                                            <p>
                                                Dokumen Lingkungan
                                            </p>
                                        </div>
                                        <div class="icon">
                                            <i class="far fa-file"></i>
                                        </div>
                                    </div>

                                    <div class="small-box px-3" style="background: #377B2B">
                                        <div class="inner text-light">
                                            <h3 class="font-weight-bold" id="ded">
                                                {{ $jumlah_dokumen_ded }}
                                            </h3>
                                            <p>
                                                Dokumen DED
                                            </p>
                                        </div>
                                        <div class="icon">
                                            <i class="far fa-file"></i>
                                        </div>
                                    </div>

                                    <div class="small-box px-3" style="background: #F47A1F">
                                        <div class="inner text-light">
                                            <h3 class="font-weight-bold" id="ded">
                                                {{ $jumlah_dokumen_fisik }}
                                            </h3>
                                            <p>
                                                Dokumen Fisik
                                            </p>
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
                                <div class="mb-4 card-title">
                                    <p class="h5 font-weight-bold">Perbandingan Jumlah Dokumen</p>
                                </div>
                                <canvas id="dokumen-chart"
                                    style="min-height: 250px; min-height: 250px; max-height: 650px; max-width: 100%;"></canvas>
                            </div>
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
