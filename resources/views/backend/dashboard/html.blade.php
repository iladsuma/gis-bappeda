<section class="content">
    <div class="container-fluid">

        <!-- Small boxes (Stat box) -->
        <div class="card">
            <div class="card-header bold font-weight-bold h4" id="title-dashboard">
                Pupuk akbar
            </div>
            <div class="card-body ">
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
            </div>
            <div class="row">
                <div class="col-4">
                    {{-- <div class="col-lg-3 col-6"> --}}
                    <!-- small box -->
                    <div class="card">
                        <div class="card-body">


                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3 id="baik"></h3>
                                    <p>Baik</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-road"></i>
                                </div>
                            </div>
                            {{-- </div> --}}
                            <!-- ./col -->
                            {{-- <div class="col-lg-3 col-6"> --}}
                            <!-- small box -->
                            <div class="small-box" style="background: #ffc107">
                                <div class="inner">
                                    <h3 id="sedang"></h3>
                                    <p>Sedang</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-road"></i>
                                </div>

                            </div>
                            {{-- </div> --}}
                            <!-- ./col -->
                            {{-- <div class="col-lg-3 col-6"> --}}
                            <!-- small box -->
                            <div class="small-box" style="background: #fd7e14">
                                <div class="inner">
                                    <h3 id="rusak_r"></h3>

                                    <p>Rusak Ringan</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-road"></i>
                                </div>
                            </div>
                            {{-- </div> --}}
                            <!-- ./col -->
                            {{-- <div class="col-lg-3 col-6"> --}}
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3 id="rusak_b"></h3>

                                    <p>Rusak Berat</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-road"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                {{-- </div> --}}
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="jalan-chart"
                                style="min-height: 250px; min-height: 250px; max-height: 650px; max-width: 100%;">></canvas>
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
