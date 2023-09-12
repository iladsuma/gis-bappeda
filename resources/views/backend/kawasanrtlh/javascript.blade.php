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
    var table = $('#table-kawasan-rtlh').DataTable({
        processing: true,
        ajax: {
            url: "{{ route('data-kawasan-rtlh.datatable') }}",
            method: 'GET'
        },
        columns: [{
                data: 'DT_RowIndex',
            },
            {
                data: 'kelurahan.nama',
            },
            {
                data: 'kelurahan.kecamatan.nama',
            },
            {
                data: 'jumlah'
            },
            {
                data: 'penanganan'
            },
            {
                data: 'tahun'
            },
            {
                data: 'id',
                width: '10px',
                orderable: false,
                render: function(data) {
                    return "<i class='fas fa-pencil edit-kawasan-rtlh' data-id='" + data + "'></i>"
                }
            },
            {
                data: null,
                width: '10px',
                orderable: false,
                render: function(data) {
                    return "<i class='fas fa-trash hapus-kawasan-rtlh' data-id='" + data.id + "'></i>"
                }
            },
        ]
    });

    // show modal create
    $(document).on('click', "#tambah-data", function() {
        $("#modalKawasanRtlhLabel").html("").append("Tambah Data RTLH");
        $("#jumlah").val("");
        $('#modalKawasanRtlh').modal('show');
        let url = "{{ route('data-kawasan-rtlh.store') }}";
        $('#kawasan-rtlh-form').attr('action', url);
        $('#kawasan-rtlh-form').attr('method', 'POST');
    });

    $(document).on('click', ".hapus-kawasan-rtlh", function() {
        swal.fire({
                title: 'Hapus',
                text: "Yakin hapus data" + " ?",
                icon: 'warning',
                showCancelButton: true,
            })
            .then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).data('id')
                    let url = "{{ route('data-kawasan-rtlh.drop', ':id') }}"

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
                                text: result,
                                icon: 'success',
                            })
                            table.ajax.reload()
                        }
                    })

                }

            })
    });

    // Proses edit kawasankumuh
    $(document).on('click', ".edit-kawasan-rtlh", function() {
        $("#modalKawasanRtlhLabel").html("Edit Data RTLH");
        $("#kelurahan_id").val("");
        $("#jumlah").val("");
        $("#penanganan").val("");
        $('#modalKawasanRtlh').modal('show');
        let id = $(this).data('id')
        let url = "{{ route('data-kawasan-rtlh.edit', ':id') }}"
        $("#pass-alert").show()
        $.ajax({
            header: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: url.replace(":id", id),
            dataType: "json",
            async: false,
            success: function(result) {
                let urlUpdate = "{{ route('data-kawasan-rtlh.update', ':id') }}"
                urlUpdate = urlUpdate.replace(':id', id)
                $('#kawasan-rtlh-form').attr('action', urlUpdate);
                $('#kawasan-rtlh-form').attr('method', 'PUT');
                $("#kelurahan").val(result.data.kelurahan_id);
                $("#jumlah").val(result.data.jumlah);
                $("#penanganan").val(result.data.penanganan);
                $("#tahun").val(result.data.tahun);
            }
        })
        // $('.modal-title').html('').append('Edit Data Perpustakaan')
        // $('#modal-opd').modal('show');
        // console.log(id);
    });

    // submit process
    $("#kawasan-rtlh-form").on("submit", function(e) {
        e.preventDefault()
        let urlSave = ($("#kawasan-rtlh-form").attr('action'))
        let method = ($("#kawasan-rtlh-form").attr('method'))

        let kawasanRtlhSave = {
            kelurahan_id: $("#kelurahan").val(),
            jumlah: $("#jumlah").val(),
            penanganan: $("#penanganan").val(),
            tahun: $("#tahun").val(),
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            type: method,
            url: urlSave,
            data: JSON.stringify(kawasanRtlhSave),
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $('#modalKawasanRtlh').modal('hide');
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
    })
</script>
