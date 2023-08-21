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
    var table = $('#table-lokus-stunting').DataTable({
        processing: true,
        ajax: {
            url: "{{ route('data-lokus-stunting.datatable') }}",
            method: 'GET'
        },
        columns: [{
                data: 'DT_RowIndex',
            },
            {
                data: 'kelurahan.kecamatan.nama',
            },
            {
                data: 'kelurahan.nama',
            },
            {
                data: 'jumlah'
            },
            {
                data: 'id',
                width: '10px',
                orderable: false,
                render: function(data) {
                    return "<i class='fas fa-pencil edit-lokus-stunting' data-id='" + data + "'></i>"
                }
            },
            {
                data: null,
                width: '10px',
                orderable: false,
                render: function(data) {
                    return "<i class='fas fa-trash hapus-lokus-stunting' data-id='" + data.id +
                        "'></i>"
                }
            },
        ]
    });

    // show modal create
    $(document).on('click', "#tambah-data", function() {
        $("#modalLokusStuntingLabel").html("").append("Tambah Data Lokus Stunting");
        $("#jumlah").val("");
        $('#modalLokusStunting').modal('show');
        let url = "{{ route('data-lokus-stunting.store') }}";
        $('#lokus-stunting-form').attr('action', url);
        $('#lokus-stunting-form').attr('method', 'POST');
    });

    $(document).on('click', ".hapus-lokus-stunting", function() {
        swal.fire({
                title: 'Hapus',
                text: "Yakin hapus data" + " ?",
                icon: 'warning',
                showCancelButton: true,
            })
            .then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).data('id')
                    let url = "{{ route('data-lokus-stunting.drop', ':id') }}"

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
    $(document).on('click', ".edit-lokus-stunting", function() {
        $("#modalLokusStuntingLabel").html("").append("Edit Data Lokus Stunting");
        $("#kelurahan_id").val("");
        $("#jumlah").val("");
        $('#modalLokusStunting').modal('show');
        let id = $(this).data('id')
        let url = "{{ route('data-lokus-stunting.edit', ':id') }}"
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
                let urlUpdate = "{{ route('data-lokus-stunting.update', ':id') }}"
                urlUpdate = urlUpdate.replace(':id', id)
                $('#lokus-stunting-form').attr('action', urlUpdate);
                $('#lokus-stunting-form').attr('method', 'PUT');
                $("#kelurahan").val(result.data.kelurahan_id);
                $("#jumlah").val(result.data.jumlah);
            }
        })

    });

    // submit process
    $("#lokus-stunting-form").on("submit", function(e) {
        e.preventDefault()
        let urlSave = ($("#lokus-stunting-form").attr('action'))
        let method = ($("#lokus-stunting-form").attr('method'))

        let lokusStuntingSave = {
            kelurahan_id: $("#kelurahan").val(),
            jumlah: $("#jumlah").val(),
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
            type: method,
            url: urlSave,
            data: JSON.stringify(lokusStuntingSave),
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $('#modalLokusStunting').modal('hide');
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
