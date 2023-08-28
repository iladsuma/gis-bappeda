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
        $("#modalDokumenLingkunganLabel").html("").append("Tambah Data Dokumen Lingkungan");
        $("#nama_kegiatan").val("");
        $("#tahun").val("");
        $("#dokumen").val("");
        $("#opd_id").val("");
        $("#lokasi_id").val("");
        $('#modalDokumenLingkungan').modal('show');
        let url = "{{ route('data-dokumen-lingkungan.store') }}";
        $('#dokumen-lingkungan-form').attr('action', url);
        $('#dokumen-lingkungan-form').attr('method', 'POST');
    });

    var table = $('#table-dokumen-lingkungan').DataTable({
        processing: true,
        ajax: {
            url: "{{ route('data-dokumen-lingkungan.datatable') }}",
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
                    return "<i class='fas fa-pencil edit-dokumen-lingkungan' data-id='" + data +
                        "'></i>"
                }
            },
            {
                data: null,
                width: '10px',
                orderable: false,
                render: function(data) {
                    return "<i class='fas fa-trash hapus-dokumen-lingkungan' data-nama='" + data
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
        $('#iframeDocumentPreview').attr('src', '{{ asset('assets/dokumen_lingkungan/') }}' + '/' + $(this)
            .data('nama'))
        $('#documentPreviewModalLabel').html('Dokumen ' + $(this).data('nama'))
        $('#documentPreviewModal').modal('show')
    })

    $("#dokumen-lingkungan-form").on("submit", function(e) {
        e.preventDefault()
        let urlSave = ($("#dokumen-lingkungan-form").attr('action'))
        let method = ($("#dokumen-lingkungan-form").attr('method'))

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
                $('#modalDokumenLingkungan').modal('hide');
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
                    $("#dokumenLingkungan-validation").html(html)
                    $("#dokumenLingkungan-validation").removeClass("d-none")
                }
            }
        });
    });

    $(document).on('click', ".edit-dokumen-lingkungan", function() {
        $("#modalDokumenLingkunganLabel").html("").append("Edit Data Dokumen Lingkungan");
        $("#nama_kegiatan").val("");
        $("#tahun").val("");
        $("#dokumen").val("");
        $("#opd_id").val("");
        $("#lokasi_id").val("");
        $('#modalDokumenLingkungan').modal('show');
        let id = $(this).data('id')
        let url = "{{ route('data-dokumen-lingkungan.edit', ':id') }}"
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
                let urlUpdate = "{{ route('data-dokumen-lingkungan.update', ':id') }}"
                urlUpdate = urlUpdate.replace(':id', id)
                $('#dokumen-lingkungan-form').attr('action', urlUpdate);
                $('#dokumen-lingkungan-form').attr('method', 'PUT');
                $("#nama_kegiatan").val(result.data.nama_kegiatan)
                $("#tahun").val(result.data.tahun)
                // $("#dokumen").val(result.data.dokumen)
                $("#opd_id").val(result.data.opd_id)
                let select2Value = []
                $.each(result.data.lokasi, function(key, lokasi) {
                    select2Value.push(lokasi.id)
                })
                $("#lokasi_id").val(select2Value).trigger('change');
            }
        })
        // console.log(id);
    });

    $(document).on('click', ".hapus-dokumen-lingkungan", function() {
        swal.fire({
                title: 'Hapus',
                text: "Yakin hapus data " + $(this).data('nama') + " ?",
                icon: 'warning',
                showCancelButton: true,
            })
            .then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).data('id')
                    let url = "{{ route('data-dokumen-lingkungan.drop', ':id') }}"

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
