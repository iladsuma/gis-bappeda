<script>
    // $(document).ready(function() {
    //     $('#dashboard').addClass('active');
    // });
    var urlw = window.location;
    $(document).ready(function() {
        // for sidebar menu entirely but not cover treeview
        $('ul.nav-sidebar a').filter(function() {
            return this.href == urlw;
        }).addClass('active');

        // for treeview
        $('ul.nav-treeview a').filter(function() {
            return this.href == urlw;
        }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
    })
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

{{-- select2 --}}
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            placeholder: 'Select an option',
            width: '30%',
            theme: 'classic'
        });
    });
</script>



{{-- chart js --}}
{{-- <script>
    var url = '/chart/ruas/dashboard'
    const canvas = document.getElementById('jalan-chart');
    var myChart = myChart = new Chart(canvas, {});
    var nama_kec = $('#list-kecamatan').find("option:selected").text();
    var nama_kel = $('#list-kelurahan').find("option:selected").text();
    // $('#title-dashboard').html("");
    // $('#title-dashboard').append("DATA " + nama_kec + "/" + nama_kel);

    function getDataChart(url) {
        $.getJSON(url, (data) => {
            $('#baik').html("");
            $('#baik').append(data.baik);
            $('#sedang').html("");
            $('#sedang').append(data.sedang);
            $('#rusak_r').html("");
            $('#rusak_r').append(data.rusak_r);
            $('#rusak_b').html("");
            $('#rusak_b').append(data.rusak_b);
            myChart.destroy()
            myChart = new Chart(canvas, {
                type: 'pie',
                data: {
                    labels: data.kondisi,
                    datasets: [{
                        label: 'My First Dataset',
                        data: [data.baik, data.sedang, data.rusak_r, data.rusak_b, ],
                        backgroundColor: [
                            '#198754',
                            '#ffc107',
                            '#fd7e14',
                            '#dc3545',
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        labels: {
                            // render: 'value',
                            fontSize: 14
                        },
                        legend: {
                            position: 'bottom',
                            // align: 'start',
                            labels: {
                                font: {
                                    size: 14,
                                },
                                padding: 30,
                            }
                        },
                    }
                    // option of cart
                }
            });
        })
    }
    getDataChart(url)
</script> --}}

<script>
    var canvas = document.getElementById('dokumen-chart');
    var lokasi = '{{ json_encode($jumlah_lokasi) }}';
    var dokumenFs = '{{ json_encode($jumlah_dokumen_fs) }}';
    var dokumenMp = '{{ json_encode($jumlah_dokumen_mp) }}';
    var dokumenLingkungan = '{{ json_encode($jumlah_dokumen_lingkungan) }}';
    var dokumenDed = '{{ json_encode($jumlah_dokumen_ded) }}';
    myChart = new Chart(canvas, {
        type: 'pie',
        data: {
            labels: ['Dokumen FS', 'Dokumen MP', 'Dokumen Lingkungan', 'Dokumen DED'],
            datasets: [{
                label: 'My First Dataset',
                data: [dokumenFs, dokumenMp, dokumenLingkungan, dokumenDed],
                // data: [1, 6, 2, 9],
                backgroundColor: [
                    '#fff000',
                    '#185678',
                    '#ACCE53',
                    '#5e3e4e',
                ],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                labels: {
                    // render: 'value',
                    fontSize: 14
                },
                legend: {
                    position: 'bottom',
                    // align: 'start',
                    labels: {
                        font: {
                            size: 14,
                        },
                        padding: 30,
                    }
                },
            }
            // option of cart
        }

    });
    var containerChart = document.getElementById('container-chart').offsetHeight;
    $('#container-box').css('height', containerChart + 'px')

</script>

{{-- get data for kecamatan and kelurahan select2  --}}
{{-- <script>
    function kecamatan() {
        $.ajax({
            type: "GET",
            url: '/get/kecamatan',
            dataType: "json",
            success: function(kec) {
                var kecamatan = kec.data,
                    listItems = ""
                $.each(kecamatan, (i, property) => {
                    listItems += "<option value='" + property.id + "'>" + property
                        .nama +
                        "</option>"
                })
                $("#list-kecamatan").append(listItems);
            }
        });
    }
    kecamatan();

    function kelurahan(id) {
        url = '/get/kelurahan/' + id;
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function(kel) {
                var kelurahan = kel.data,
                    listItems = ""
                $.each(kelurahan, (i, property) => {
                    listItems += "<option value='" + property.id + "'>" + property
                        .nama +
                        "</option>"
                })
                $("#list-kelurahan").append(listItems);
            }
        });
    }

    $('#list-kecamatan').on('change', function() {
        $("#list-kelurahan").html("<option value=0>SEMUA KELURAHAN</option>")
        var id = this.value;
        (id == 0) ? $("#list-kelurahan").prop({
            "disabled": true
        }): $("#list-kelurahan").prop({
            "disabled": false
        })
        kelurahan(id);
    });

    //  filter-chart
    $("#filter-chart").on('submit', function(e) {
        e.preventDefault();
        var kecamatan = $('#list-kecamatan').val();
        var kelurahan = $('#list-kelurahan').val();
        (kecamatan == 0) ? url = '/chart/ruas/dashboard': url = '/chart/ruas/' + kecamatan + '/' + kelurahan +
            '/dashboard';

        getDataChart(url)
        const nama_kec = $('#list-kecamatan').find("option:selected").text();
        const nama_kel = $('#list-kelurahan').find("option:selected").text();
        $('#title-dashboard').html("");
        if (kecamatan == 0) {
            $('#title-dashboard').append("DATA " + nama_kec + " / " + nama_kel)
        } else if (kelurahan == 0) {
            $('#title-dashboard').append("DATA KECAMATAN " + nama_kec + " / " + nama_kel);
        } else {
            $('#title-dashboard').append("DATA KECAMATAN " + nama_kec + " / KELURAHAN " + nama_kel);
        }

    })
</script> --}}

{{-- <script>
    // $(document).ready(function() {
    //     $('#dashboard').addClass('active');
    // });
    var urlw = window.location;
    $(document).ready(function() {
        // for sidebar menu entirely but not cover treeview
        $('ul.nav-sidebar a').filter(function() {
            return this.href == urlw;
        }).addClass('active');

        // for treeview
        $('ul.nav-treeview a').filter(function() {
            return this.href == urlw;
        }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
    })
</script> --}}
