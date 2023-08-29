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
    var table = $('#table-user').DataTable({
        processing: true,
        ajax: {
            url: "{{ route('admin-user.datatable') }}",
            method: 'GET'
        },
        columns: [{
                data: 'DT_RowIndex',
            },
            {
                data: 'name',
            },
            {
                data: 'username',
            },
            {
                data: 'opd.nama',
            },
            {
                data: 'roles[].name',
            },
            {
                data: 'id',
                width: '10px',
                orderable: false,
                render: function(data) {
                    return "<i class='fas fa-pencil edit-user' data-id='" + data + "'></i>"
                }
            },
            {
                data: null,
                width: '10px',
                orderable: false,
                render: function(data) {
                    return "<i class='fas fa-trash hapus-user' data-nama='" + data.name +
                        "' data-id='" + data.id + "'></i>"
                }
            },
        ]
    })

    $(document).on('click', ".hapus-user", function() {
        swal.fire({
                title: 'Hapus',
                text: "Yakin hapus data " + $(this).data('name') + " ?",
                icon: 'warning',
                showCancelButton: true,
            })
            .then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).data('id')
                    let url = "{{ route('admin-user.drop', ':id') }}"

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


    $(document).on('click', "#tambah-data", function() {
        $("#modalAdminUserLabel").html("").append("Tambah Data User");
        $("#name").val("");
        $("#username").val("");
        $("#opd_id").val("");
        $("#role_id").val("");
        $("#password").val("");
        $('#modalAdminUser').modal('show');
        let url = "{{ route('admin-user.store') }}";
        $('#admin-user-form').attr('action', url);
        $('#admin-user-form').attr('method', 'POST');
    });

    $("#admin-user-form").on("submit", function(e) {
        e.preventDefault()
        let urlSave = $("#admin-user-form").attr("action")
        let method = $("#admin-user-form").attr("method")
        let dataUser = new FormData()
        dataUser.append("name", $("#name").val())
        dataUser.append("username", $("#username").val())
        dataUser.append("opd_id", $("#opd_id").val())
        dataUser.append("role_id", $("#role_id").val())
        dataUser.append("password", $("#password").val())

        if (method == "PUT") {
            dataUser.append("_method", "PUT")
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            type: 'POST',
            url: urlSave,
            data: dataUser,
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
                $('#modalAdminUser').modal('hide');
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
                    html += "</ul>";
                    $("#admin-user-validation").html(html)
                    $("#admin-user-validation").removeClass("d-none")
                }
            }
        });
    })
</script>
