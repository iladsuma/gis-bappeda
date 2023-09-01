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

<script>
    $(document).on('click', "#tambah-data", function() {
        $("#modalDokumenFisikLabel").html("").append("Tambah Data Dokumen Fisik");
        $("#nama_kegiatan").val("");
        $("#tahun").val("");
        $("#dokumen").val("");
        $("#opd_id").val("");
        $("#lokasi_id").val("").trigger("change");
        $('#modalDokumenFisik').modal('show');
        let url = "{{ route('data-dokumen-fisik.store') }}";
        $('#dokumen-fisik-form').attr('action', url);
        $('#dokumen-fisik-form').attr('method', 'POST');
        $('#dokumen').attr("required", "on");
        $('#dokumen-message').html("");
    });

    var table = $('#table-dokumen-fisik').DataTable({
        processing: true,
        ajax: {
            url: "{{ route('data-dokumen-fisik.datatable') }}",
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
                data: 'lokasi[].nama',
            },
            {
                data: 'tahun',
            },
            {
                data: 'dokumen',
                render: function(data) {
                    return "<button class='btn btn-light border border-success btn-sm document-preview' data-nama='" +
                        data + "' data-toggle='modal'>Lihat Dokumen</button>"
                }
            },
            {
                data: 'foto',
                render: function(data) {
                    return "<button class='btn btn-light border border-success btn-sm foto-preview' data-nama='" +
                        data + "' data-toggle='modal'>Lihat Foto</button>"
                }
            },
            {
                data: 'id',
                width: '10px',
                orderable: false,
                render: function(data) {
                    return "<i class='fas fa-pencil edit-dokumen-fisik' data-id='" + data + "'></i>"
                }
            },
            {
                data: null,
                width: '10px',
                orderable: false,
                render: function(data) {
                    return "<i class='fas fa-trash hapus-dokumen-fisik' data-nama='" + data
                        .nama_kegiatan + "' data-id='" + data.id + "'></i>"
                }
            },
        ]
    })

    $('#lokasi_id').select2({
        placeholder: "Pilih minimal 1 atau lebih lokasi ...",
        width: '100%',
        theme: 'classic',
        // dropdownParent: $("#search")
    });

    $(document).on('click', '.document-preview', function() {
        $('#iframeDocumentPreview').attr('src', '{{ asset('assets/dokumen_fisik/') }}' + '/' + $(this).data(
            'nama'))
        $('#documentPreviewModalLabel').html('Dokumen ' + $(this).data('nama'))
        $('#documentPreviewModal').modal('show')
    })

    $(document).on('click', '.foto-preview', function() {
        $('#iframeImagePreview').attr('src', '{{ asset('assets/dokumen_fisik/foto') }}' + '/' + $(this).data(
            'nama'))
        $('#imagePreviewModalLabel').html('Dokumen ' + $(this).data('nama'))
        $('#imagePreviewModal').modal('show')
    })

    $("#dokumen-fisik-form").on("submit", function(e) {
        e.preventDefault()
        let urlSave = ($("#dokumen-fisik-form").attr('action'))
        let method = ($("#dokumen-fisik-form").attr('method'))

        var formData = new FormData();
        formData.append('nama_kegiatan', $("#nama_kegiatan").val());
        formData.append('tahun', $("#tahun").val());
        formData.append('opd_id', $("#opd_id").val());
        formData.append('lokasi_id', $("#lokasi_id").val());
        formData.append('dokumen', $('#dokumen:input[type=file]')[0].files[0]);
        formData.append('foto', $('#foto:input[type=file]')[0].files[0]);

        if (method == 'PUT') {
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
                $('#modalDokumenFisik').modal('hide');
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
                    $("#dokumenFisik-validation").html(html)
                    $("#dokumenFisik-validation").removeClass("d-none")
                }
            }
        });
    });

    $(document).on('click', ".edit-dokumen-fisik", function() {
        $("#modalDokumenFisikLabel").html("").append("Edit Data Dokumen Fisik");
        $("#nama_kegiatan").val("");
        $("#tahun").val("");
        $("#dokumen").val("");
        $("#foto").val("");
        $("#opd_id").val("");
        $("#lokasi_id").val("").trigger("change");
        $('#modalDokumenFisik').modal('show');
        let id = $(this).data('id')
        let url = "{{ route('data-dokumen-fisik.edit', ':id') }}"
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
                let urlUpdate = "{{ route('data-dokumen-fisik.update', ':id') }}"
                urlUpdate = urlUpdate.replace(':id', id)
                $('#dokumen-fisik-form').attr('action', urlUpdate);
                $('#dokumen-fisik-form').attr('method', 'PUT');
                $("#nama_kegiatan").val(result.data.nama_kegiatan)
                $("#tahun").val(result.data.tahun)
                // $("#dokumen").val(result.data.dokumen)
                $("#opd_id").val(result.data.opd_id)
                let select2Value = []
                $.each(result.data.lokasi, function(key, lokasi) {
                    select2Value.push(lokasi.id)
                })
                $("#lokasi_id").val(select2Value).trigger('change');
                $('#dokumen').removeAttr("required");
                $('#dokumen-message').html("*kosongkan jika tidak ingin merubah dokumen");
            }
        })
        // console.log(id);
    });

    $(document).on('click', ".hapus-dokumen-fisik", function() {
        swal.fire({
                title: 'Hapus',
                text: "Yakin hapus data " + $(this).data('nama') + " ?",
                icon: 'warning',
                showCancelButton: true,
            })
            .then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).data('id')
                    let url = "{{ route('data-dokumen-fisik.drop', ':id') }}"

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
