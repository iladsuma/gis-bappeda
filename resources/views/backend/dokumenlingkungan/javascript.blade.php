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
<script>
    var url = '/chart/ruas/dashboard'
    const canvas = document.getElementById('jalan-chart');
    var myChart = myChart = new Chart(canvas, {});
    var nama_kec = $('#list-kecamatan').find("option:selected").text();
    var nama_kel = $('#list-kelurahan').find("option:selected").text();
    $('#title-dashboard').html("");
    $('#title-dashboard').append("DATA " + nama_kec + "/" + nama_kel);

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
</script>

{{-- get data for kecamatan and kelurahan select2  --}}
<script>
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
</script>

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

<script>
    $(document).on('click', "#tambah-data", function() {
        $("#modalDokumenLingkunganLabel").html("").append("Tambah Data Dokumen Lingkungan");
        $("#nama_kegiatan").val("");
        $("#tahun").val("");
        $("#dokumen").val("");
        $("#opd_id").val("");
        $('#modalDokumenLingkungan').modal('show');
        let url = "{{ route('data-dokumen-lingkungan.store') }}";
        $('#dokumen-lingkungan-form').attr('action', url);
        $('#dokumen-lingkungan-form').attr('method', 'POST');
    });

    var table = $('#table-dokumen-lingkungan').DataTable({
        processing: true,
        ajax: {
            url: "{{ route('data-dokumen-lingkungan.datatable') }}",
            method: 'GET'
        },
        columns: [{
            data: 'DT_RowIndex',
        },
        {
            data: 'nama_kegiatan',
        },
        {
            data: 'opd.nama',
        },
        {
            data: 'tahun',
        },
        {
            data: 'dokumen',
        },
        {
            data: 'id',
            width: '10px',
            orderable: false,
            render: function(data) {
                return "<i class='fas fa-pencil edit-dokumen-lingkungan' data-id='" + data + "'></i>"
            }
        },
        {
            data: null,
            width: '10px',
            orderable: false,
            render: function(data) {
                return "<i class='fas fa-trash hapus-dokumen-lingkungan' data-nama='" + data.nama_kegiatan + "' data-id='" + data.id + "'></i>"
            }
        },
    ]
    })

    $("#dokumen-lingkungan-form").on("submit", function(e) {
        e.preventDefault()
        let urlSave = ($("#dokumen-lingkungan-form").attr('action'))
        let method = ($("#dokumen-lingkungan-form").attr('method'))

        var formData = new FormData();
        formData.append('nama_kegiatan', $("#nama_kegiatan").val());
        formData.append('tahun', $("#tahun").val());
        formData.append('opd_id', $("#opd_id").val());
        formData.append('dokumen', $('#dokumen:input[type=file]')[0].files[0]);

        if(method == 'PUT') {
            formData.append('_method', 'PUT');
        }

        console.log($('#dokumen:input[type=file]')[0].files[0]);

        for (var pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            type: 'POST',
            url: urlSave,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                swal.fire({
                    title: 'Berhasil',
                    text: data,
                    icon: 'success',
                }).then(function() {
                    table.ajax.reload();
                });
                $('#modalDokumenLingkungan').modal('hide');
            },
            error: (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.responseJSON.errors)
                if (xhr.responseJSON.hasOwnProperty('errors')) {
                    var html =
                        "<ul style=justify-content: space-between;'>";
                    for (item in xhr.responseJSON.errors) {
                        if (xhr.responseJSON.errors[item].length) {
                            for (var i = 0; i < xhr.responseJSON.errors[item]
                                .length; i++) {
                                html += "<li class='dropdown-item'>" +
                                    "<i class='fas fa-times' style='color: red;'></i> &nbsp&nbsp&nbsp&nbsp" +
                                    xhr
                                    .responseJSON
                                    .errors[item][i] +
                                    "</li>"
                            }

                        }
                    }
                    html += "</ul>";
                    // swal.fire({
                    //     title: 'Error',
                    //     html: html,
                    //     icon: 'warning',
                    // });
                    $("#dokumenLingkungan-validation").html(html)
                    $("#dokumenLingkungan-validation").removeClass("d-none")
                }
            }
        });
    });

    $(document).on('click', ".edit-dokumen-lingkungan", function() {
        $("#modalDokumenLingkunganLabel").html("").append("Edit Data Dokumen Lingkungan");
        $("#nama_kegiatan").val("");
        $("#tahun").val("");
        $("#dokumen").val("");
        $("#opd_id").val("");
        $('#modalDokumenLingkungan').modal('show');
        let id = $(this).data('id')
        let url = "{{ route('data-dokumen-lingkungan.edit', ':id') }}"
        $("#pass-alert").show()
        $.ajax({
            header: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: url.replace(":id", id),
            dataType: "json",
            async: false,
            success: function(result) {
                console.log(result);
                let urlUpdate = "{{ route('data-dokumen-lingkungan.update', ':id') }}"
                urlUpdate = urlUpdate.replace(':id', id)
                $('#dokumen-lingkungan-form').attr('action', urlUpdate);
                $('#dokumen-lingkungan-form').attr('method', 'PUT');
                $("#nama_kegiatan").val(result.data.nama_kegiatan)
                $("#tahun").val(result.data.tahun)
                $("#dokumen").val(result.data.dokumen)
                $("#opd_id").val(result.data.opd_id)
            }
        })
        // console.log(id);
    });

    $(document).on('click', ".hapus-dokumen-lingkungan", function() {
        swal.fire({
            title: 'Hapus',
            text: "Yakin hapus data " + $(this).data('nama') + " ?",
            icon: 'warning',
            showCancelButton: true,
        })
        .then((result) => {
            if(result.isConfirmed) {
            let id = $(this).data('id')
            let url = "{{ route('data-dokumen-lingkungan.drop', ':id') }}"

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: url.replace(":id", id),
                    type: 'delete',
                    async: false,
                    success: function(result) {
                        swal.fire({
                            title: 'Berhasil',
                            text: 'Data berhasil dihapus',
                            icon: 'success',
                        })
                        table.ajax.reload()
                    }
                })

            }

        })
    });
</script>
