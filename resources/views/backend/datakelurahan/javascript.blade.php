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
                render: function(data) {
                    return data.kecamatan.kode + "." + data.kode
                }
            },
            {
                data: 'geometry',
                render: function(data) {
                    return "<a href='javascript:void(0)' >" + data + "</a>"
                }
            },
            {
                data: 'id',
                width: '10px',
                orderable: false,
                render: function(data) {
                    return "<i class='fas fa-pencil edit-kelurahan' data-id='" + data + "'></i>"
                }
            },
            {
                data: null,
                width: '10px',
                orderable: false,
                render: function(data) {
                    return "<i class='fas fa-trash hapus-kelurahan' data-nama='" + data.nama +
                        "' data-id='" +
                        data.id + "'></i>"
                }
            },
        ]
    });

    // show modal create
    $(document).on('click', "#tambah-data", function() {
        $("#modalKelurahanLabel").html("").append("Tambah Data Kelurahan");
        $("#nama").val("");
        $("#kode").val("");
        $('#modalKelurahan').modal('show');
        $('#kelurahan-form').attr('action', "{{ route('data-kelurahan.store') }}");
        $('#kelurahan-form').attr('method', 'POST');
        $("#geometry").attr("required", true)
    });

    // show modal update
    $(document).on('click', ".edit-kelurahan", function() {
        let url = "{{ route('data-kelurahan.edit', ':id') }}"
        url = url.replace(":id", $(this).data("id"))
        $("input").val("")
        $("#kecamatan").val("")
        $("#geometry").val("")
        $("#geometry").attr("required", false)
        $.ajax({
            header: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: url,
            dataType: "json",
            async: false,
            success: function(result) {
                console.log(result);
                let data = result.data
                let urlUpdate = "{{ route('data-kelurahan.update', ':id') }}"
                urlUpdate = urlUpdate.replace(":id", data.id)
                $("#kelurahan-form").attr("action", urlUpdate)
                $("#kelurahan-form").attr("method", "PUT")
                $("#nama").val(data.nama)
                $("#kode").val(data.kode)
                $("#kecamatan").val(data.kecamatan_id)
                $("#geometry").val(data.coordinate)
                $("#modalKelurahan").modal("show")
            }
        })
    });
    $(document).on('click', ".hapus-kelurahan", function() {
        swal.fire({
            title: 'Hapus',
            text: "Yakin hapus data" + $(this).data('nama') + " ?",
            icon: 'warning',
            showCancelButton: true,
        })
        .then((result) => {
            if(result.isConfirmed) {
            let id = $(this).data('id')
            let url = "{{ route('data-kelurahan.drop', ':id') }}"

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: url.replace(":id", id),
                    type: 'delete',
                    async: false,
                    success: function(result) {
                        console.log(result);
                        swal.fire({
                            title: result.title,
                            text: result.message,
                            icon: result.icon
                        })
                        table.ajax.reload()
                    }
                })

            }

        })
    });

    // submit process
    $("#kelurahan-form").on("submit", function(e) {
        e.preventDefault()
        let urlSave = ($("#kelurahan-form").attr('action'))
        let method = ($("#kelurahan-form").attr('method'))

        dataKelurahan = new FormData()

        dataKelurahan.append("nama", $("#nama").val())
        dataKelurahan.append("kode", $("#kode").val())
        dataKelurahan.append("kecamatan_id", $("#kecamatan").val())
        dataKelurahan.append("geometry", $("#geometry:input[type=file]")[0].files[0])
        if (method == "PUT") {
            dataKelurahan.append("_method", "PUT")
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            type: "POST",
            url: urlSave,
            data: dataKelurahan,
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

                $('#modalKelurahan').modal('hide');
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

    })
</script>
