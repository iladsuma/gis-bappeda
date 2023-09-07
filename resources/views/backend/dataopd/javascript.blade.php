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
    var table = $('#table-opd').DataTable({
        processing: true,
        ajax: {
            url: "{{ route('data-opd.datatable') }}",
            method: 'GET'
        },
        columns: [{
                data: 'DT_RowIndex',
            },
            {
                data: 'nama',
            },
            {
                data: 'alamat',
            },
            {
                data: 'deskripsi',
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
                    return "<i class='fas fa-trash hapus-opd' data-nama='" + data.nama + "' data-id='" +
                        data.id + "'></i>"
                }
            },
        ]
    })

    $(document).on('click', "#tambah-data", function() {
        $("#modalOpdLabel").html("").append("Tambah Data OPD");
        $("#nama").val("");
        $("#alamat").val("");
        $("#deskripsi").val("");
        $('#modalOpd').modal('show');
        let url = "{{ route('data-opd.store') }}";
        $('#opd-form').attr('action', url);
        $('#opd-form').attr('method', 'POST');
    });

    $(document).on('click', ".hapus-opd", function() {
        swal.fire({
                title: 'Hapus',
                text: "Yakin hapus data" + $(this).data('nama') + " ?",
                icon: 'warning',
                showCancelButton: true,
            })
            .then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).data('id')
                    let url = "{{ route('data-opd.drop', ':id') }}"

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

    $(document).on('click', ".edit-opd", function() {
        $("#modalOpdLabel").html("").append("Edit Data OPD");
        $("#nama").val("");
        $("#alamat").val("");
        $("#deskripsi").val("");
        $('#modalOpd').modal('show');
        let id = $(this).data('id')
        let url = "{{ route('data-opd.edit', ':id') }}"
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
                let urlUpdate = "{{ route('data-opd.update', ':id') }}"
                urlUpdate = urlUpdate.replace(':id', id)
                $('#opd-form').attr('action', urlUpdate);
                $('#opd-form').attr('method', 'PUT');
                $("#nama").val(result.data.nama)
                $("#alamat").val(result.data.alamat)
                $("#deskripsi").val(result.data.deskripsi)
            }
        })
        $('.modal-title').html('').append('Edit Data OPD')
        $('#modal-perpus').modal('show');
        // console.log(id);
    });

    $("#opd-form").on("submit", function(e) {
        e.preventDefault()
        let urlSave = ($("#opd-form").attr('action'))
        let method = ($("#opd-form").attr('method'))

        let opdSave = {
            nama: $("#nama").val(),
            alamat: $("#alamat").val(),
            deskripsi: $("#deskripsi").val(),
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            type: method,
            url: urlSave,
            data: JSON.stringify(opdSave),
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
                $('#modalOpd').modal('hide');
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
                    $("#opd-validation").html(html)
                    $("#opd-validation").removeClass("d-none")
                }
            }
        });


    })
</script>
