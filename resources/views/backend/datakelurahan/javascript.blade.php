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

    // show data
    var table = $('#table-kelurahan').DataTable({
        processing: true,
        ajax: {
            url: "{{ route('data-kelurahan.datatable') }}",
            method: 'GET'
        },
        columns: [{
                data: 'DT_RowIndex',
            },
            {
                data: 'nama',
            },
            {
                data: 'kecamatan.nama',
            },
            {
                data: null,
                render:function(data){
                    return data.kecamatan.kode+ "."+ data.kode
                }
            },
            {
                data: 'id',
                width: '10px',
                orderable: false,
                render: function(data) {
                    return "<i class='fas fa-pencil edit-opd' data-id='" + data + "'></i>"
                }
            },
            {
                data: null,
                width: '10px',
                orderable: false,
                render: function(data) {
                    return "<i class='fas fa-trash hapus-opd' data-nama='" + data.nama + "' data-id='" + data.id + "'></i>"
                }
            },
        ]
    });

    // show modal create
    $(document).on('click', "#tambah-data", function() {
        $("#modalKelurahanLabel").html("").append("Tambah Data Kelurahan");
        $("#nama").val("");
        $("#kode").val("");
        // $("#kecamatan").val("");
        $('#modalKelurahan').modal('show');
        let url = "{{ route('data-kelurahan.store') }}";
        $('#kelurahan-form').attr('action', url);
        $('#kelurahan-form').attr('method', 'POST');
    });

    // submit process
    $("#kelurahan-form").on("submit", function(e) {
        e.preventDefault()
        let urlSave = ($("#kelurahan-form").attr('action'))
        let method = ($("#kelurahan-form").attr('method'))

        let kelurahanSave = {
            nama: $("#nama").val(),
            kode: $("#kode").val(),
            kecamatan_id: $("#kecamatan").val(),
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            type: method,
            url: urlSave,
            data: JSON.stringify(kelurahanSave),
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
            },
            error: (xhr, ajaxOptions, thrownError) => {
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
                    html += '</ul>';
                    swal.fire({
                    title: 'Error',
                    text: html,
                    icon: 'warning',
                });
                }
            }
        });
        $('#modalKelurahan').modal('hide');

    })
</script>
