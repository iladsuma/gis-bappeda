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
    $(document).ready(function() {

        // datatable lokasi kegiatan
        var table = $('#table-data-lokasi').DataTable({
            processing: true,
            ajax: {
                url: "{{ route('data-lokasi.datatable') }}",
                method: 'GET'
            },
            columns: [{
                    data: 'DT_RowIndex',
                },
                {
                    data: 'nama',
                },
                {
                    data: 'kelurahan.nama',
                },
                {
                    data: 'kelurahan.kecamatan.nama',
                },
                {
                    data: 'alamat',
                },
                // {
                //     data: 'deskripsi',
                // },
                {
                    data: 'coordinate',
                },
                {
                    data: 'foto',
                    render: function(data) {
                        return "<button class='btn btn-light btn-sm border border-success preview-foto' data-nama='" +
                            data + "'>Lihat Foto</button>"
                    }
                },
                {
                    data: 'id',
                    width: '10px',
                    orderable: false,
                    render: function(data) {
                        return "<i class='fas fa-pencil edit-data-lokasi' data-id='" + data +
                            "'></i>"
                    }
                },
                {
                    data: null,
                    width: '10px',
                    orderable: false,
                    render: function(data) {
                        return "<i class='fas fa-trash hapus-data-lokasi' data-nama='" + data
                            .nama_kegiatan + "' data-id='" + data.id + "'></i>"
                    }
                },
            ]
        })


        // leaflet for add coordinate
        let map = new L.map('modal-map', {
            fullscreenControl: true,
        })

        map.setView([-8.098244, 112.165077], 15);

        let google = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map)

        let imagery = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                maxZoom: 18,
            })

        let osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });

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
            drawPolyline: true,
            drawRectangle: false,
            drawPolygon: true,
            drawText: false,
            editMode: false,
            dragMode: false,
            cutPolygon: false,
            removalMode: true,
            rotateMode: false,
        }

        let optionsAfterDraw = {
            drawMarker: true,
            drawCircleMarker: false,
            drawCircle: false,
            drawPolyline: true,
            drawRectangle: false,
            drawPolygon: true,
            drawText: false,
            editMode: false,
            dragMode: false,
            cutPolygon: false,
            removalMode: true,
            rotateMode: false,
        }


        map.pm.addControls(optionsBeforeDraw)

        let drawnItems = L.geoJSON()

        map.on("pm:create", (e) => {
            // map.pm.disableDraw()
            let drawnLayer = e.layer
            let feature = drawnLayer.feature = drawnLayer.feature || {};
            feature.type = feature.type || "Feature";
            var props = feature.properties = feature.properties || {};
            props.lokasi = null;
            props.kelurahan = null;
            props.alamat = null;
            drawnItems.addLayer(drawnLayer)
            // map.pm.addControls(optionsAfterDraw)
            // addPopup(drawnLayer)
            $("#koordinat").val(JSON.stringify(drawnItems.toGeoJSON()))
        })

        map.on("pm:remove", (e) => {
            map.pm.disableGlobalDragMode()
            removedLayer = e.layer
            drawnItems.removeLayer(removedLayer)
            $("#koordinat").val(JSON.stringify(drawnItems.toGeoJSON()))
            if (drawnItems.toGeoJSON().features.length < 1) {
                $("#koordinat").val("")
                // map.pm.addControls(optionsBeforeDraw)
            }
        })

        function addPopup(layer) {
            // var content = document.createElement("textarea");
            // content.addEventListener("keyup", function() {
            //     layer.feature.properties.desc = content.value;
            //     $("#koordinat").val(JSON.stringify(drawnItems.toGeoJSON()))
            // });
            // layer.on("popupopen", function() {
            //     content.value = layer.feature.properties.desc;
            //     content.focus();
            // });
            layer.bindPopup(content).openPopup();
        }


        $('#modal-lokasi-kegiatan').on('shown.bs.modal', function() {
            setTimeout(function() {
                map.invalidateSize();
            }, 500);
        });


        // show preview foto before upload
        $("#foto-lokasi").change(function() {
            const file = this.files[0]
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $("#foto-preview").attr("src", event.target.result)
                }
                reader.readAsDataURL(file)
                $("#foto-preview").attr("hidden", false)
            }
        })

        // call modal create data lokasi
        $(document).on('click', "#tambah-data", function() {
            $("#lokasi-kegiatan-form").attr("action", "{{ route('data-lokasi.store') }}")
            $("#lokasi-kegiatan-form").attr("method", "POST")
            $("input").val("")
            $("textarea").val("")
            $("select").val("")
            $("#modal-lokasi-kegiatan").modal("show")
            $("#foto-preview").attr("hidden", true)
            $("#foto-lokasi").val("")
            if (drawnLayer != undefined) {
                map.removeLayer(drawnLayer)
            }
        })

        // call modal update data lokasi
        $(document).on('click', ".edit-data-lokasi", function() {
            if (drawnLayer != undefined) {
                map.removeLayer(drawnLayer)
            }
            let url = "{{ route('data-lokasi.edit', ':id') }}"
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
                    let data = result.data
                    let urlUpdate = "{{ route('data-lokasi.update', ':id') }}"
                    urlUpdate = urlUpdate.replace(":id", data.id)
                    $("#lokasi-kegiatan-form").attr("action", urlUpdate)
                    $("#lokasi-kegiatan-form").attr("method", "PUT")
                    $("#nama-lokasi").val(data.nama)
                    $("#kelurahan").val(data.kelurahan_id)
                    $("#alamat").val(data.alamat)
                    $("#koordinat").val(data.coordinate)
                    $("#modal-lokasi-kegiatan").modal("show")
                    // let coorArray = data.coordinate.split(",")
                    let geometry = L.geoJSON(JSON.parse(result.data.coordinate)).addTo(map)
                    drawnLayer = geometry
                }
            })
        });

        // submit modal form lokasi-kegiatan
        $("#lokasi-kegiatan-form").on("submit", function(e) {
            e.preventDefault()
            let urlSave = $("#lokasi-kegiatan-form").attr("action")
            let method = $("#lokasi-kegiatan-form").attr("method")
            let dataLokasi = new FormData()
            dataLokasi.append("nama_lokasi", $("#nama-lokasi").val())
            dataLokasi.append("kelurahan_id", $("#kelurahan").val())
            dataLokasi.append("alamat", $("#alamat").val())
            dataLokasi.append("coordinate", $("#koordinat").val())
            dataLokasi.append("foto", $("#foto-lokasi")[0].files[0])

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


    });
</script>
