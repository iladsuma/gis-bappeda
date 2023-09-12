<script>
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
    $(document).ready(function() {
        var table = $("#role-table").DataTable({
            processing: true,
            ajax: {
                url: "{{ route('admin-role.datatable') }}",
                method: 'GET'
            },
            columns: [{
                    data: 'DT_RowIndex',
                },
                {
                    data: 'name',
                },
                {
                    data: 'id',
                    width: '10px',
                    orderable: false,
                    render: function(data) {
                        return "<i class='fas fa-pencil edit-role' data-id='" + data + "'></i>"
                    }
                },
                {
                    data: null,
                    width: '10px',
                    orderable: false,
                    render: function(data) {
                        return "<i class='fas fa-trash hapus-role' data-nama='" + data.name +
                            "' data-id='" + data.id + "'></i>"
                    }
                },
            ]
        })

        // add role
        $(document).on("click", ".tambah-data", function() {
            let urlStore = "{{ route('admin-role.store') }}";
            $('#role-form').attr('action', urlStore);
            $('#role-form').attr('method', 'POST');
            $('#modal-title').html('Tambah Role/Hak Akses');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: "{{ route('admin-role.create') }}",
                dataType: "json",
                async: false,
                success: function(result) {
                    $('#role-name').val('');
                    $('#row-role').html('');
                    let num = 1;
                    let cbNum = 1;
                    $.each(result.permissionsFormatted, (i, data) => {
                        $('#row-role').append(
                            `<div class="col-lg-5 form-check mb-5" id="role-title-` +
                            num + `">
                            <span class="font-weight-bold h7">` + i.toUpperCase() + `</span><hr class="mb-2 mt-1">
                            </div>`)
                        $.each(data, (key, dt) => {
                            $('#role-title-' + num).append(
                                `<input name="permissions" class="form-check-input" type="checkbox" id="checkbox-` +
                                cbNum + `" value="` + dt.value + `" >
                            <label for="checkbox-` + cbNum + `" class="form-check-label">` + dt.name + `</label>
                            <br>`);

                            cbNum++
                        })
                        num++;
                    })
                    // Display Modal
                    $('#modal-form').modal('show');
                }
            })
        })


        //edit role
        $(document).on("click", ".edit-role", function() {
            var id = $(this).data('id');
            let urlUpdate = "{{ route('admin-role.update', ':id') }}";
            urlUpdate = urlUpdate.replace(':id', id)
            $('#role-form').attr('action', urlUpdate);
            $('#role-form').attr('method', 'PUT');
            $('#modal-title').html('Edit Role/Hak Akses');
            let url = "{{ route('admin-role.edit', ':id') }}"
            url = url.replace(':id', id)
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: '/admin/role/' + id + '/edit',
                dataType: "json",
                async: false,
                success: function(result) {
                    $('#role-name').val(result.role.name);
                    $('#row-role').html('');
                    let num = 1;
                    let cbNum = 1;
                    let cbVal = Object.values(result.rolePermissions);
                    var centang = 'checked';
                    $.each(result.permissionsFormatted, (i, data) => {
                        $('#row-role').append(
                            `<div class="col-lg-5 form-check mb-5" id="role-title-` +
                            num + `">
                            <span class="font-weight-bold h7">` + i.toUpperCase() +
                            `</span><hr class="mb-2 mt-1"></div>`)
                        $.each(data, (x, dt) => {
                            (cbVal.includes(dt.value)) ? centang =
                                'checked': centang = '';
                            $('#role-title-' + num).append(
                                `<input name="permissions" class="form-check-input" type="checkbox" id="checkbox-` +
                                cbNum + `" value="` + dt.value + `" ` +
                                centang + `>
                            <label class="form-check-label" for="checkbox-` + cbNum + `">` + dt.name + `</label>
                            <br>`);

                            cbNum++
                        })
                        num++;
                    })
                    // Display Modal
                    $('#modal-form').modal('show');
                }
            });
        })

        //edit role

        // modal role form on submit
        $('#role-form').on('submit', (e) => {
            e.preventDefault();
            let permission = [];
            let roleName = $('#role-name').val();
            $('input[name="permissions"]:checked').each(function() {
                permission.push(this.value);
            });
            let urlSave = ($("#role-form").attr('action'))
            let method = ($("#role-form").attr('method'))
            let formData = new FormData;
            formData.append('role_name', roleName);
            formData.append('permission', permission);
            if (method == 'PUT') {
                formData.append('_method', 'PUT')
            }

            for (var pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    // 'Content-Type': 'application/json',
                },
                type: "POST",
                url: urlSave,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('#modal-form').modal('hide');
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
                            "<ul style='justify-content: space-between;'>";
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
                            html: html,
                            icon: 'warning',
                        });
                    }
                }
            });
            return false;

        });


        // delete role
        $(document).on("click", ".hapus-role", function() {
            let id = $(this).data('id');
            let nama = $(this).data('nama');
            let urlDelete = "{{ route('admin-role.destroy', ':id') }}"
            urlDelete = urlDelete.replace(":id", id)
            Swal.fire({
                title: 'HAPUS ROLE ' + '" ' +
                    nama + ' "',
                text: ' Apakah Anda yakin ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        type: "DELETE",
                        url: urlDelete,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            Swal.fire(
                                data.status,
                                data.message,
                                data.icon,
                            );
                            table.ajax.reload();
                        },
                        error: (xhr, ajaxOptions,
                            thrownError) => {
                            console.log(xhr.responseJSON
                                .message);
                            if (xhr.responseJSON
                                .hasOwnProperty(
                                    'errors')) {
                                for (item in xhr
                                    .responseJSON
                                    .errors) {
                                    if (xhr
                                        .responseJSON
                                        .errors[
                                            item]
                                        .length) {
                                        for (var i =
                                                0; i <
                                            xhr
                                            .responseJSON
                                            .errors[
                                                item
                                            ]
                                            .length; i++
                                        ) {
                                            alert(xhr
                                                .responseJSON
                                                .errors[
                                                    item
                                                ]
                                                [
                                                    i
                                                ]
                                            );
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            })
        })
    })
</script>
