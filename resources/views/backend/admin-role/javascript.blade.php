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
                        return "<i class='fas fa-pencil edit-opd' data-id='" + data + "'></i>"
                    }
                },
                {
                    data: null,
                    width: '10px',
                    orderable: false,
                    render: function(data) {
                        return "<i class='fas fa-trash hapus-opd' data-nama='" + data.nama +
                            "' data-id='" + data.id + "'></i>"
                    }
                },
            ]
        })

        // add role
        $(document).on("click", ".tambah-data", function() {
            let urlStore = "/admin/role/store";
            $('#role-form').attr('action', urlStore);
            $('#role-form').attr('method', 'POST');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: '/admin/role/create',
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
    })
</script>
