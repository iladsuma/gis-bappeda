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
        $("#modalDokumenDedLabel").html("").append("Tambah Data Dokumen Detail Enginer Design");
        $("#nama_kegiatan").val("");
        $("#tahun").val("");
        $("#dokumen").val("");
        $("#opd_id").val("");
        $("#lokasi_id").val("");
        $('#modalDokumenDed').modal('show');
        let url = "{{ route('data-dokumen-ded.store') }}";
        $('#dokumen-ded-form').attr('action', url);
        $('#dokumen-ded-form').attr('method', 'POST');
        $('#dokumen').attr("required", "on");
        $('#dokumen-message').html("");
    });

    var table = $('#table-dokumen-ded').DataTable({
        processing: true,
        ajax: {
            url: "{{ route('data-dokumen-ded.datatable') }}",
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
                data: 'id',
                width: '10px',
                orderable: false,
                render: function(data) {
                    return "<i class='fas fa-pencil edit-dokumen-ded' data-id='" + data + "'></i>"
                }
            },
            {
                data: null,
                width: '10px',
                orderable: false,
                render: function(data) {
                    return "<i class='fas fa-trash hapus-dokumen-ded' data-nama='" + data
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
        $('#iframeDocumentPreview').attr('src', '{{ asset('assets/dokumen_ded/') }}' + '/' + $(this).data(
            'nama'))
        $('#documentPreviewModalLabel').html('Dokumen ' + $(this).data('nama'))
        $('#documentPreviewModal').modal('show')
    })

    $("#dokumen-ded-form").on("submit", function(e) {
        e.preventDefault()
        let urlSave = ($("#dokumen-ded-form").attr('action'))
        let method = ($("#dokumen-ded-form").attr('method'))

        var formData = new FormData();
        formData.append('nama_kegiatan', $("#nama_kegiatan").val());
        formData.append('tahun', $("#tahun").val());
        formData.append('opd_id', $("#opd_id").val());
        formData.append('lokasi_id', $("#lokasi_id").val());
        formData.append('dokumen', $('#dokumen:input[type=file]')[0].files[0]);

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
                $('#modalDokumenDed').modal('hide');
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
                    $("#dokumenDed-validation").html(html)
                    $("#dokumenDed-validation").removeClass("d-none")
                }
            }
        });
    });

    $(document).on('click', ".edit-dokumen-ded", function() {
        $("#modalDokumenDedLabel").html("").append("Edit Data Dokumen Detail Enginer Design");
        $("#nama_kegiatan").val("");
        $("#tahun").val("");
        $("#dokumen").val("");
        $("#opd_id").val("");
        $("#lokasi_id").val("");
        $('#modalDokumenDed').modal('show');
        let id = $(this).data('id')
        let url = "{{ route('data-dokumen-ded.edit', ':id') }}"
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
                let urlUpdate = "{{ route('data-dokumen-ded.update', ':id') }}"
                urlUpdate = urlUpdate.replace(':id', id)
                $('#dokumen-ded-form').attr('action', urlUpdate);
                $('#dokumen-ded-form').attr('method', 'PUT');
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

    $(document).on('click', ".hapus-dokumen-ded", function() {
        swal.fire({
                title: 'Hapus',
                text: "Yakin hapus data " + $(this).data('nama') + " ?",
                icon: 'warning',
                showCancelButton: true,
            })
            .then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).data('id')
                    let url = "{{ route('data-dokumen-ded.drop', ':id') }}"

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
