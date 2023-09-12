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
    $(document).ready(function() {
        // show data
        var table = $('#table-sumur-pdam').DataTable({
            processing: true,
            ajax: {
                url: "{{ route('data-lokasi-sumur-pdam.datatable') }}",
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
                    data: 'kelurahan.nama'
                },
                {
                    data: 'kelurahan.kecamatan.nama'
                },
                {
                    data: 'id',
                    width: '10px',
                    orderable: false,
                    render: function(data) {
                        return "<i class='fas fa-pencil edit-sumur-pdam' data-id='" + data +
                            "'></i>"
                    }
                },
                {
                    data: null,
                    width: '10px',
                    orderable: false,
                    render: function(data) {
                        return "<i class='fas fa-trash hapus-sumur-pdam' data-id='" + data.id +
                            "'></i>"
                    }
                },
            ]
        });

        let map = new L.map('modal-map', {
            fullscreenControl: true,
        })

        function setView(coordinate) {
            map.setView(coordinate, 15);
        }

        let google = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        })

        let imagery = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                maxZoom: 18,
            })

        let osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var drawnLayer
        let controlLayer = L.control.layers({
            "Google": google,
            "OpenStreet": osm,
            "Satelit": imagery,
        }, null, {
            "collapsed": true
        }).addTo(map)


        // geoman tool
        let optionsBeforeDraw = {
            drawMarker: true,
            drawCircleMarker: false,
            drawCircle: false,
            drawPolyline: false,
            drawRectangle: false,
            drawPolygon: false,
            drawText: false,
            editMode: false,
            dragMode: false,
            cutPolygon: false,
            removalMode: false,
            rotateMode: false,
        }

        let optionsAfterDraw = {
            drawMarker: false,
            drawCircleMarker: false,
            drawCircle: false,
            drawPolyline: false,
            drawRectangle: false,
            drawPolygon: false,
            drawText: false,
            editMode: false,
            dragMode: false,
            cutPolygon: false,
            removalMode: true,
            rotateMode: false,
        }


        map.pm.addControls(optionsBeforeDraw)
        var drawnItems = new L.geoJSON()

        map.on("pm:create", (e) => {
            drawnLayer = e.layer
            drawnItems.addLayer(drawnLayer)
            map.pm.disableDraw()
            map.pm.addControls(optionsAfterDraw)
            console.log(drawnLayer.getLatLng())
            let lat = drawnLayer.getLatLng().lat
            let lng = drawnLayer.getLatLng().lng
            $("#koordinat").val(lat + "," + lng)
        })

        map.on("pm:remove", (e) => {
            // map.pm.disableGlobalDragMode()
            map.pm.addControls(optionsBeforeDraw)
            removedLayer = e.layer
            console.log(removedLayer.toGeoJSON());
            // drawnItems.removeLayer(removedLayer)
            removedLayer.removeFrom(drawnItems);
            // drawnItems.clearLayers()

            console.log(drawnItems.toGeoJSON());
            $("#koordinat").val(JSON.stringify(drawnItems.toGeoJSON()))
            if (drawnItems.toGeoJSON().features.length < 1) {
                $("#koordinat").val("")
            }
        })

        $('#modal-lokasi-spam').on('shown.bs.modal', function() {
            setTimeout(function() {
                map.invalidateSize();
            }, 500);
        });

        $(document).on('click', "#tambah-data", function() {
            $("#modal-title").html("").append("Tambah Data Spam");
            $("#nama").val("");
            $("#alamat").val("");
            $("#koordinat").val("");
            $("#terpasang").val("");
            $("#aktif").val("");
            let url = "{{ route('data-lokasi-spam.store') }}";
            $('#lokasi-spam-form').attr('action', url);
            $('#lokasi-spam-form').attr('method', 'POST');
            map.eachLayer(function(layer) {
                if (layer.toGeoJSON) {
                    map.removeLayer(layer);
                }
            });
            setView([-8.098244, 112.165077])
            map.pm.addControls(optionsBeforeDraw)
            $('#modal-lokasi-spam').modal('show');
        });

        // edit spam
        $(document).on('click', ".edit-lokasi-spam", function() {
            drawnItems.clearLayers()
            map.eachLayer(function(layer) {
                if (layer.toGeoJSON) {
                    map.removeLayer(layer);
                }
            });
            let url = "{{ route('data-lokasi-spam.edit', ':id') }}"
            url = url.replace(":id", $(this).data("id"))
            $("input").val("")
            $.ajax({
                header: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: url,
                dataType: "json",
                async: false,
                success: function(result) {
                    console.log(result)
                    let data = result.data
                    let urlUpdate = "{{ route('data-lokasi-spam.update', ':id') }}"
                    urlUpdate = urlUpdate.replace(":id", data.id)
                    $("#lokasi-spam-form").attr("action", urlUpdate)
                    $("#lokasi-spam-form").attr("method", "PUT")
                    $("#nama").val(data.nama)
                    $("#kelurahan").val(data.kelurahan_id)
                    $("#alamat").val(data.alamat)
                    $("#tahun").val(data.tahun)
                    $("#terpasang").val(data.terpasang)
                    $("#aktif").val(data.aktif)
                    $("#koordinat").val(data.lat + "," + data.lng)
                    map.pm.addControls(optionsAfterDraw)
                    marker = L.marker([data.lat, data.lng])
                    marker.addTo(drawnItems)
                    drawnItems.addTo(map)
                    $("#modal-lokasi-spam").modal("show")
                    setView([data.lat, data.lng])
                }
            })
        });


        // submit modal form lokasi-spam
        $("#lokasi-spam-form").on("submit", function(e) {
            e.preventDefault()
            let urlSave = $("#lokasi-spam-form").attr("action")
            let method = $("#lokasi-spam-form").attr("method")
            let dataLokasi = new FormData()
            dataLokasi.append("nama", $("#nama").val())
            dataLokasi.append("alamat", $("#alamat").val())
            dataLokasi.append("kelurahan_id", $("#kelurahan").val())
            dataLokasi.append("coordinate", $("#koordinat").val())
            dataLokasi.append("foto", $("#foto-lokasi")[0].files[0])
            dataLokasi.append("tahun", $("#tahun").val())
            dataLokasi.append("terpasang", $("#terpasang").val())
            dataLokasi.append("aktif", $("#aktif").val())

            if (method == "PUT") {
                dataLokasi.append("_method", "PUT")
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                type: 'POST',
                url: urlSave,
                data: dataLokasi,
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
                    $('#modal-lokasi-kegiatan').modal('hide');
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
                        $("#lokasi-validation").html(html)
                        $("#lokasi-validation").removeClass("d-none")
                    }
                }
            });
        })

        $(document).on('click', ".hapus-lokasi-spam", function() {
            swal.fire({
                    title: 'Hapus',
                    text: "Yakin hapus data" + " ?",
                    icon: 'warning',
                    showCancelButton: true,
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        let id = $(this).data('id')
                        let url = "{{ route('data-lokasi-spam.drop', ':id') }}"

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


    });
</script>
