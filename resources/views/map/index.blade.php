<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gis Bappeda</title>
    <link rel="stylesheet" href="{{ asset('assets/leaflet/css/leaflet.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('assets/leaflet/css/leaflet-sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/leaflet/css/leaflet.groupedlayercontrol.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/leaflet/css/leaflet-geoman.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        html,
        body .map-container {
            height: 100%;

        }

        #sidebar {
            visibility: hidden;
        }

        body {
            /* font-family: "Helvetica Neue", Arial, Helvetica, sans-serif !important; */
            font-size: .90rem;
        }

        #map {
            display: block;
            position: absolute;
            height: auto;
            bottom: 0;
            top: 0;
            left: 0;
            right: 0;
            margin-bottom: 0;
        }

        table.dataTable th,
        table.dataTable td {
            /* font-size: .7em; */
            /* font-size: 12px; */
        }

        .nav-tabs .nav-item .nav-link {
            color: #000000;
        }

        .nav-tabs .nav-item .nav-link.active {
            color: #0080FF;
        }

        .tab-pane {
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            border-radius: 0px 0px 10px 10px;
            padding: 10px;
        }

        .nav-tabs {
            margin-bottom: -10px;
        }

        #locationModal {
            z-index: 2001;
        }

        .modal-dialog-location {
            background-color: rgba(255, 255, 255, 0.8);
        }

        .select2-results__option--selected {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container-map">
        <div id="map"></div>
    </div>

    @include('layouts.map.sidebar')
    @include('layouts.map.modal')

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/e4d20a5f83.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/leaflet/js/leaflet.js') }}" crossorigin=""></script>
    <script src="{{ asset('assets/leaflet/js/leaflet-sidebar.js') }}"></script>
    <script src="{{ asset('assets/leaflet/js/leaflet.groupedlayercontrol.js') }}"></script>
    <script src="{{ asset('assets/leaflet/js/leaflet.ajax.js') }}"></script>
    <script src="{{ asset('assets/leaflet/js/leaflet-geoman.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src='https://unpkg.com/@turf/turf@6/turf.min.js'></script>


    {{-- sweet alert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- leaflet script --}}
    <script>
        $(document).ready(function() {
            $(".sidebar").css('visibility', 'visible')

            let map = L.map('map', {
                zoomControl: false
            })
            map.setView([-8.098244, 112.165077], 13);


            let google = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            })

            let imagery = L.tileLayer(
                'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                    maxZoom: 18,
                }).addTo(map)

            let osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            });

            let baseLayers = {
                "Satelite": imagery,
                "Google": google,
                "OpenStreet": osm,
            }

            let style = {
                pmIgnore: true,
                color: "yellow",
                opacity: 1
            }

            let styleKawasanKumuh = {
                pmIgnore: true,
                color: "red",
                fillColor: "white",
                weight: 1,
            }

            let styleKawasanRTLH = {
                pmIgnore: true,
                color: "cyan",
                fillColor: "white",
                weight: 1,
            }

            let styleKemiskinan = {
                pmIgnore: true,
                color: "red",
                fillColor: "white",
                weight: 1,
            }

            let styleStunting = {
                pmIgnore: true,
                color: "orange",
                fillColor: "white",
                weight: 1,
            }


            let sananwetan = new L.GeoJSON.AJAX("assets/leaflet/geojson/ln_sananwetan.geojson", style)
                .addTo(map)
            let kepanjenkidul = new L.GeoJSON.AJAX("assets/leaflet/geojson/ln_kepanjenkidul.geojson",
                style).addTo(map)
            let sukorejo = new L.GeoJSON.AJAX("assets/leaflet/geojson/ln_sukorejo.geojson", style)
                .addTo(map)
            let imageUrl = "{{ asset('assets/leaflet/images/rdtr.png') }}"
            let latLngBounds = L.latLngBounds([
                [-8.13700008392334, 112.131721496582],
                [-8.05541801452637, 112.200820922852]
            ]);
            let errorOverlayUrl = "RDTR Gagal Dimuat";
            let altText = "RDTR Gagal Dimuat";
            let rdtr = L.imageOverlay(imageUrl, latLngBounds, {
                opacity: .8,
                errorOverlayUrl: errorOverlayUrl,
                alt: altText,
                interactive: true
            });

            let layerGroup = L.geoJSON();
            let layerPerencanaan = L.featureGroup();
            let layerKawasanKumuh = L.featureGroup();
            let layerRtlh = L.featureGroup();
            let layerKemiskinan = L.featureGroup();
            let layerStunting = L.featureGroup();
            let layerSpam = L.featureGroup();
            let layerPdam = L.featureGroup();

            let locationIcon = L.icon({
                iconUrl: 'assets/icon/location-icon.png',
                iconSize: [27, 30], // size of the icon
            });

            let waterIcon = L.icon({
                iconUrl: 'assets/icon/water-icon.png',
                iconSize: [27, 30], // size of the icon
            });


            let groupedOverlays = {
                "Peta Tematik ": {
                    "Kecamatan Sananwetan": sananwetan,
                    "Kecamatan Kepanjenkidul": kepanjenkidul,
                    "Kecamatan Sukorejo": sukorejo,
                    "Tata Ruang (RDTR)": rdtr,
                },
                "Peta Perencanaan": {
                    "Dokumen Perencanaan": layerPerencanaan
                },
                "Data Pendukung": {
                    "Kawasan Kumuh": layerKawasanKumuh,
                    "Kawasan RTLH": layerRtlh,
                    "Lokus Kemiskinan": layerKemiskinan,
                    "Lokus Stunting": layerStunting,
                    "Jaringan Spam": layerSpam,
                    "Jaringan Pipa PDAM": layerPdam,
                }
            };


            // create custom control layer
            L.Control.Watermark = L.Control.extend({
                onAdd: function(map) {
                    var img = L.DomUtil.create('img');

                    img.src = '{{ asset('assets/image/logo/watermark.png') }}';
                    img.style.height = '80px';

                    return img;
                },

                onRemove: function(map) {
                    // Nothing to do here
                }
            });

            L.control.watermark = function(opts) {
                return new L.Control.Watermark(opts);
            }

            L.control.watermark({
                position: 'topleft'
            }).addTo(map);

            L.control.zoom({
                position: 'topleft'
            }).addTo(map);

            let controlLayer = L.control.groupedLayers(baseLayers, groupedOverlays, {
                collapsed: false,
                // exclusiveGroups: ["Data Pendukung"],
                groupCheckboxes: false
            }).addTo(map);

            let sidebar = L.control.sidebar('sidebar', {
                position: 'right'
            }).addTo(map)

            // leaflet geoman
            map.pm.addControls({
                position: 'topleft',
                drawMarker: false,
                drawRectangle: false,
                drawCircleMarker: false,
                drawText: false,
                editMode: true,
                dragMode: false,
                cutPolygon: false,
                removalMode: true,
                rotateMode: false
            })

            // perhitungan sederhana
            map.on("pm:create", (e) => {
                var ukur = (e) => {
                    var layer = e.layer,
                        shape = e.shape,
                        nf = Intl.NumberFormat();
                    if (shape === 'Polygon') {
                        var seeArea = turf.area(layer.toGeoJSON());
                        var ha = seeArea / 10000;
                        var mPersegi = seeArea;
                        if (mPersegi > 10000) {
                            layer.bindPopup("Luas " + nf.format(ha.toFixed(2)) + " Ha");
                        } else {
                            layer.bindPopup("Luas " + nf.format(mPersegi.toFixed(2)) + " Meter²");
                        }
                    }

                    if (shape === 'Line') {

                        var seeArea = turf.length(layer.toGeoJSON());
                        var meter = seeArea * 1000;
                        var kilometer = seeArea;
                        if (meter < 1000) {
                            layer.bindPopup("Jarak " + nf.format(meter.toFixed(2)) + " Meter");
                        } else {
                            layer.bindPopup("Jarak " + nf.format(kilometer.toFixed(2)) + " Kilometer");
                        }
                    }

                    if (shape === 'Circle') {
                        if (layer._mRadius < 1000) {
                            layer.bindPopup("Radius " + nf.format(layer._mRadius.toFixed(2)) +
                                " Meter");
                        } else {
                            layer.bindPopup("Radius " + nf.format((layer._mRadius / 1000).toFixed(2)) +
                                " Kilometer");
                        }
                    }
                }
                ukur(e);
                e.layer.on("pm:edit", (e) => {
                    ukur(e);
                })
            })

            // add control layer to sidebar
            let htmlControlLayer = controlLayer.getContainer();
            $('#control-layer-container').append(htmlControlLayer);

            map.on('overlayadd', function(event) {
                if (event.name == "Dokumen Perencanaan") {
                    layerPerencanaan.clearLayers()
                    let url = "{{ route('map.lokasi-all') }}"
                    getDataPerencanaan(url)
                }

                if (event.name == "Kawasan Kumuh") {
                    layerKawasanKumuh.clearLayers()
                    let url = "{{ route('map.kawasan-kumuh') }}"
                    getDataPendukung(url, styleKawasanKumuh)
                }

                if (event.name == "Kawasan RTLH") {
                    layerRtlh.clearLayers()
                    let url = "{{ route('map.kawasan-rtlh') }}"
                    getDataPendukung(url, styleKawasanRTLH);
                }

                if (event.name == "Lokus Kemiskinan") {
                    layerKemiskinan.clearLayers()
                    let url = "{{ route('map.lokus-kemiskinan') }}"
                    getDataPendukung(url, styleKemiskinan);
                }

                if (event.name == "Lokus Stunting") {
                    layerStunting.clearLayers()
                    let url = "{{ route('map.lokus-stunting') }}"
                    getDataPendukung(url, styleStunting);
                }

                if (event.name == "Jaringan Pipa PDAM") {
                    layerPdam.clearLayers()
                    let jaringanPdam = new L.GeoJSON.AJAX("assets/jaringan_pdam/jaringan_pdam.geojson", {
                        color: "#51dce0",
                        opacity: 2,
                        weight: 1.5
                    })
                    layerPdam.addLayer(jaringanPdam).addTo(map)
                }
                if (event.name == "Jaringan Spam") {
                    layerSpam.clearLayers()
                    let jaringanSpam = new L.GeoJSON.AJAX("assets/jaringan_pdam/jaringan_spam.geojson", {
                        onEachFeature: function(feature, layer) {
                            let latLng = layer.getLatLng()
                            let marker = L.marker([latLng.lat,
                                latLng.lng
                            ], {
                                icon: waterIcon
                            })
                            layerSpam.addLayer(marker).addTo(map)
                            spamOnClick(marker, feature.properties)
                        }
                    })
                }
            })

            // function ajax call data for any pendukung
            function getDataPerencanaan(url) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    type: "GET",
                    url: url,
                    dataType: "json",
                    success: function(result) {
                        if (result.jumlah == 0) {
                            swal.fire({
                                title: "Maaf",
                                text: "Lokasi tidak ditemukan",
                                icon: "warning"
                            })
                        }
                        $(".jumlah-lokasi").html("Jumlah Lokasi : " + result.jumlah)
                        layerGroup.clearLayers()
                        $.each(result.data, function(index, data) {
                            let geometry = JSON.parse(data.coordinate)
                            let layer = L.geoJSON(geometry, {
                                onEachFeature: function(feature, layer) {
                                    if (feature.geometry.type == 'LineString') {
                                        let buffering = turf.buffer(feature, 2.5, {
                                            'units': 'meters'
                                        })
                                        let bufferedLayer = L.geoJSON(buffering, {
                                            pmIgnore: true,
                                        })
                                        let latLng = bufferedLayer.getBounds()
                                            .getCenter()
                                        layerGroup.addLayer(bufferedLayer)
                                            .addTo(
                                                map)
                                        layerOnClick(bufferedLayer, data,
                                            latLng)
                                    } else {
                                        let latLng;
                                        layer.options.pmIgnore = true
                                        if (feature.geometry.type == "Point") {
                                            latLng = layer.getLatLng()
                                            let marker = L.marker([latLng.lat,
                                                latLng.lng
                                            ], {
                                                icon: locationIcon
                                            })
                                            layerGroup.addLayer(marker).addTo(map)
                                            layerOnClick(marker, data, latLng)
                                        } else {
                                            layerGroup.addLayer(layer).addTo(map)
                                            latLng = layer.getBounds()
                                                .getCenter()
                                            layerOnClick(layer, data, latLng)
                                        }
                                    }
                                    if (result.method == 'all') {
                                        layerGroup.addTo(layerPerencanaan)
                                        center = layerPerencanaan.getBounds()
                                        map.flyToBounds(center);
                                    }
                                    if (result.method == 'spesifik') {
                                        center = layerGroup.getBounds()
                                        map.flyToBounds(center);
                                    }
                                    if (result.method == 'multiple') {
                                        center = layerGroup.getBounds()
                                        map.flyToBounds(center);
                                    }
                                    if (result.method == 'wilayah') {
                                        center = layerGroup.getBounds()
                                        map.flyToBounds(center);
                                    }

                                },
                            })
                        })
                    }
                });
            }

            // function ajax call data for any pendukung
            function getDataPendukung(url, style) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    type: "GET",
                    url: url,
                    dataType: "json",
                    success: function(result) {
                        $.each(result.data, function(index, data) {
                            let polygon = new L.GeoJSON.AJAX("assets/geometry_kelurahan/" + data
                                .kelurahan.geometry, style)
                            polygon.options.fillOpacity = (data.jumlah / result.max_value) * 1
                            if (result.judul == "Kawasan Kumuh") {
                                polygon.addTo(layerKawasanKumuh)
                            } else if (result.judul == "RTLH") {
                                polygon.addTo(layerRtlh)
                            } else if (result.judul == "Lokus Kemiskinan") {
                                polygon.addTo(layerKemiskinan)
                            } else if (result.judul == "Lokus Stunting") {
                                polygon.addTo(layerStunting)
                            }
                            polygonOnClick(polygon, data, result.judul)
                        })
                    }
                });
            }

            function spamOnClick(layer, data) {
                let content = `<img class="img-fluid rounded " src="{{ asset('assets/jaringan_pdam/foto_spam/`+data.image+`') }}"></img>
                            <table class="table table-sm table-striped" style="max-width=250px">
                                <tr>
                                    <th>Nama</th>
                                    <td>` + data.Name + `</td>
                                </tr>
                                <tr>
                                    <th>Kecamatan</th>
                                    <td>` + data.kecamatan + `</td>
                                </tr>
                                <tr>
                                    <th>Kelurahan</th>
                                    <td>` + data.kelurahan + `</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>` + data.alamat + `</td>
                                </tr>
                                <tr>
                                    <th>Tahun</th>
                                    <td>` + data.tahun + `</td>
                                </tr>
                                <tr>
                                    <th>Terpasang</th>
                                    <td>` + data.terpasang + `</td>
                                </tr>
                                <tr>
                                    <th>Aktif</th>
                                    <td>` + data.aktif + `</td>
                                </tr>
                            </table>`
                layer.on("click", function(e) {
                    if (e.target._popup == undefined) {
                        layer.bindPopup(content, {
                            maxWidth: 200,
                            closeButton: false
                        }).openPopup()
                    } else {
                        layer.bindPopup()
                    }
                })
            }

            // function get data for marker and set the content and bind the pop up layer on click
            function layerOnClick(layer, data, latLng) {
                let content = ` <img class="img-fluid rounded" src="{{ asset('assets/foto_lokasi/`+data.foto+`') }}"></img>
                            <table class="table table-sm table-striped">
                                <tr>
                                    <th>Nama</th>
                                    <td>` + data.nama + `</td>
                                </tr>
                                <tr>
                                    <th>Kecamatan</th>
                                    <td>` + data.kelurahan.kecamatan.nama + `</td>
                                </tr>
                                <tr>
                                    <th>Kelurahan</th>
                                    <td>` + data.kelurahan.nama + `</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>` + data.alamat + `</td>
                                </tr>

                            </table>
                            <table class="table table-sm table-striped">
                                <tr>
                                    <td class="text-center">
                                        <a href="#" class="open-modal btn btn-light btn-sm" data-id="` + data.id + `"
                                        data-nama="` + data.nama + `">
                                            <i class="fa fa-info-circle"></i> Detail
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-light btn-sm open-map" data-lat="` + latLng.lat +
                    `" data-lng="` + latLng.lng + `">
                                            <i class="fa fa-info-circle"></i> Maps
                                        </a>
                                    </td>
                                </tr>
                            </table>`

                layer.on("click", function(e) {
                    $(".detail-tab").attr("data-id", data.id)
                    if (e.target._popup == undefined) {
                        layer.bindPopup(content, {
                            maxWidth: 250,
                            closeButton: false
                        }).openPopup()
                    } else {
                        layer.bindPopup()
                    }
                })
            }

            // open googlemaps in new window
            $(document).on("click", ".open-map", function() {
                let latLng = $(this).data("lat") + "," + $(this).data("lng")
                url = "https://www.google.com/maps/search/" + latLng
                window.open(url, '_blank');
            })

            // function polygon form ajax add the content and bind the pop up
            function polygonOnClick(polygon, data, judul) {
                let content = `<p class="text-center h7" >` + judul + `</p>
                        <table class="table table-sm table-striped">
                            <tr>
                                <th>Kelurahan</th>
                                <td>` + data.kelurahan.nama + `</td>
                            </tr>
                            <tr>
                                <th>Jumlah</th>
                                <td>` + data.jumlah + `</td>
                            </tr>
                        </table>`


                polygon.on("click", function(e) {
                    if (e.target._popup == undefined) {
                        polygon.bindPopup(content).openPopup()
                    } else {
                        polygon.bindPopup()
                    }
                })
            }

            // open the modal of detail marker
            $(document).on("click", ".open-modal", function() {
                let id = $(this).data("id")
                let nama = $(this).data("nama")
                $("#detail-title").html("").html("Detail " + nama)

                //datatable fs in modal detail
                if ($.fn.DataTable.isDataTable('#table-fs')) {
                    $('#table-fs').DataTable().destroy()
                }

                var urlFs = "{{ route('map.datatable-fs', ':id') }}"
                urlFs = urlFs.replace(":id", id)
                var tableFs = $('#table-fs').DataTable({
                    processing: true,
                    ajax: {
                        url: urlFs,
                        method: 'GET'
                    },
                    lengthChange: false,
                    searching: false,
                    responsive: true,
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
                            data: 'tahun',
                        },
                        {
                            data: 'dokumen',
                            render: function(data) {
                                return `<a href="assets/dokumen_fs/` + data +
                                    `" target="_blank" >` +
                                    data + `</a>`
                            },
                        },
                    ],
                })

                //datatable fs in modal detail
                if ($.fn.DataTable.isDataTable('#table-mp')) {
                    $('#table-mp').DataTable().destroy()
                }
                var urlMp = "{{ route('map.datatable-mp', ':id') }}"
                urlMp = urlMp.replace(":id", id)
                var tableMp = $('#table-mp').DataTable({
                    processing: true,
                    ajax: {
                        url: urlMp,
                        method: 'GET'
                    },
                    lengthChange: false,
                    searching: false,
                    responsive: true,
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
                            data: 'tahun',
                        },
                        {
                            data: 'dokumen',
                            render: function(data) {
                                return `<a href="assets/dokumen_mp/` + data +
                                    `" target="_blank" >` +
                                    data + `</a>`
                            },
                        },
                    ]
                })

                //datatable lingkungan in modal detail
                if ($.fn.DataTable.isDataTable('#table-lingkungan')) {
                    $('#table-lingkungan').DataTable().destroy()
                }
                var urlLingkungan = "{{ route('map.datatable-lingkungan', ':id') }}"
                urlLingkungan = urlLingkungan.replace(":id", id)
                var tablelingkungan = $('#table-lingkungan').DataTable({
                    processing: true,
                    ajax: {
                        url: urlLingkungan,
                        method: 'GET'
                    },
                    lengthChange: false,
                    searching: false,
                    responsive: true,
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
                            data: 'tahun',
                        },
                        {
                            data: 'dokumen',
                            render: function(data) {
                                return `<a href="assets/dokumen_lingkungan/` + data +
                                    `" target="_blank" >` +
                                    data + `</a>`
                            },
                        },
                    ]
                })

                //datatable DED in modal detail
                if ($.fn.DataTable.isDataTable('#table-ded')) {
                    $('#table-ded').DataTable().destroy()
                }
                var urlDed = "{{ route('map.datatable-ded', ':id') }}"
                urlDed = urlDed.replace(":id", id)
                var tablelingkungan = $('#table-ded').DataTable({
                    processing: true,
                    ajax: {
                        url: urlDed,
                        method: 'GET'
                    },
                    lengthChange: false,
                    searching: false,
                    responsive: true,
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
                            data: 'tahun',
                        },
                        {
                            data: 'dokumen',
                            render: function(data) {
                                return `<a href="assets/dokumen_ded/` + data +
                                    `" target="_blank" >` +
                                    data + `</a>`
                            },
                        },
                    ]
                })

                //datatable dokumen FISIK in modal detail
                if ($.fn.DataTable.isDataTable('#table-fisik')) {
                    $('#table-fisik').DataTable().destroy()
                }
                var urlFisik = "{{ route('map.datatable-fisik', ':id') }}"
                urlFisik = urlFisik.replace(":id", id)
                var tablelingkungan = $('#table-fisik').DataTable({
                    processing: true,
                    ajax: {
                        url: urlFisik,
                        method: 'GET'
                    },
                    lengthChange: false,
                    searching: false,
                    responsive: true,
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
                            data: 'tahun',
                        },
                        {
                            data: 'dokumen',
                            render: function(data) {
                                return `<a href="assets/dokumen_fisik/` + data +
                                    `" target="_blank" >` +
                                    data + `</a>`
                            },
                        },
                        {
                            data: 'foto',
                            render: function(data) {
                                return `<a href="assets/dokumen_fisik/foto/` + data +
                                    `" target="_blank" >` +
                                    data + `</a>`
                            },
                        },
                    ]
                })

                $("#modal-detail").modal("show")

            })

            $(document).on('click', '#location-modal', function() {
                if ($.fn.DataTable.isDataTable('#table-location')) {
                    $('#table-location').DataTable().destroy()
                }
                var tableLocation = $('#table-location').DataTable({
                    processing: true,
                    ajax: {
                        url: "{{ route('map.datatable-modal') }}",
                        method: 'GET'
                    },
                    lengthChange: false,
                    searching: true,
                    responsive: true,
                    columns: [{
                            data: 'DT_RowIndex',
                            render: function(data) {
                                return `<div class='text-center'>${data}</div>`;
                            }
                        },
                        {
                            data: 'nama',
                        },
                        {
                            data: 'alamat',
                        },
                        {
                            data: 'dokumen_fs',
                            render: function(data) {
                                if (data.length > 0) {
                                    return '<div class="text-center"><i class="fas fa-check-circle" style="color: #0dba21;"></i></div>';
                                } else {
                                    return '<div class="text-center"><i class="fas fa-times-circle" style="color: #f03d3d;"></i></div>';
                                }
                            }
                        },
                        {
                            data: 'dokumen_mp',
                            render: function(data) {
                                if (data.length > 0) {
                                    return '<div class="text-center"><i class="fas fa-check-circle" style="color: #0dba21;"></i></div>';
                                } else {
                                    return '<div class="text-center"><i class="fas fa-times-circle" style="color: #f03d3d;"></i></div>';
                                }
                            }
                        },
                        {
                            data: 'dokumen_lingkungan',
                            render: function(data) {
                                if (data.length > 0) {
                                    return '<div class="text-center"><i class="fas fa-check-circle" style="color: #0dba21;"></i></div>';
                                } else {
                                    return '<div class="text-center"><i class="fas fa-times-circle" style="color: #f03d3d;"></i></div>';
                                }
                            }
                        },
                        {
                            data: 'dokumen_ded',
                            render: function(data) {
                                if (data.length > 0) {
                                    return '<div class="text-center"><i class="fas fa-check-circle" style="color: #0dba21;"></i></div>';
                                } else {
                                    return '<div class="text-center"><i class="fas fa-times-circle" style="color: #f03d3d;"></i></div>';
                                }
                            }
                        },
                        {
                            data: 'dokumen_fisik',
                            render: function(data) {
                                if (data.length > 0) {
                                    return '<div class="text-center"><i class="fas fa-check-circle" style="color: #0dba21;"></i></div>';
                                } else {
                                    return '<div class="text-center"><i class="fas fa-times-circle" style="color: #f03d3d;"></i></div>';
                                }
                            }
                        },
                        {
                            data: 'id',
                            render: function(data) {
                                return `<div class="text-center"><button class="btn btn-light fokus" data-id="${data}"><i class="fas fa-search"></i></button></div>`;
                            },
                        },
                    ],
                    order: [],
                    columnDefs: [{
                        targets: 'document',
                        orderable: false,
                    }]
                });
            });

            $(document).on('click', '.fokus', function(e) {
                map.removeLayer(layerPerencanaan);
                let url = '{{ route('map.lokasi-spesifik', ':id') }}';
                url = url.replace(':id', $(this).data('id'));
                getDataPerencanaan(url);
                $('#locationModal').modal('hide');
            });

            $("#cari-lokasi").on('submit', function(event) {
                event.preventDefault()
                map.removeLayer(layerPerencanaan);
                let ids = $('#lokasi-select').val()
                let url = "{{ route('map.lokasi-filter', ':id') }}"
                url = url.replace(":id", ids)
                getDataPerencanaan(url);
            });

            $("#lokasi-administrasi").on('submit', function(event) {
                event.preventDefault()
                map.removeLayer(layerPerencanaan);
                let kecamatan = $('#kecamatan').val()
                let kelurahan = $('#kelurahan').val()
                let url = "{{ route('map.lokasi-administrasi', [':kec', ':kel']) }}"
                url = url.replace(":kec", kecamatan)
                url = url.replace(":kel", kelurahan)
                getDataPerencanaan(url);
            });
        })
    </script>

    {{-- search script --}}
    <script>
        $(document).on("change", "#kecamatan", function() {
            $("#kelurahan").html("<option value=0>--- Pilih Kelurahan ---</option>");
            ($(this).val() == 0) ? $("#kelurahan").prop({
                "disabled": true
            }): $("#kelurahan").prop({
                "disabled": false
            })
            url = "{{ route('map.get-kelurahan', ':id') }}";
            url = url.replace(':id', $(this).val())
            $.get(url, function(data, status) {
                optionItem = ""
                $.each(data.kelurahan, (key, val) => {
                    $("#kelurahan").append(`<option value="` + val.id + `">` + val.nama +
                        `</option>`)
                })
            });
        })
        $(document).ready(function() {
            $('.perencanaan').select2({
                placeholder: "Masukkan lokasi perencanaan..",
                width: '100%',
                theme: 'classic',
                dropdownParent: $("#search")
            });

            $('.kecamatan').select2({
                width: '100%',
                theme: 'classic',
                dropdownParent: $("#search")
            });
            $('.kelurahan').select2({
                width: '100%',
                theme: 'classic',
                dropdownParent: $("#search")
            });

        });
    </script>

    <script>
        $(document).on('click', "#profile-edit-modal", function() {
            $("#profileEditModalLabel").html("").append("Edit Profile");
            $("#name").val("");
            $("#username").val("");
            $("#password").val();
            $("#avatar").val();
            $('#profileEditModal').modal('show');
            let id = "{{ Auth::user()->id }}"
            let url = "{{ route('profile.edit', ':id') }}"
            $("#pass-alert").show()
            $.ajax({
                header: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: url.replace(":id", id),
                dataType: "json",
                async: false,
                success: function(result) {
                    let urlUpdate = "{{ route('profile.update', ':id') }}"
                    urlUpdate = urlUpdate.replace(':id', id)
                    $('#form-edit-profile').attr('action', urlUpdate);
                    $('#form-edit-profile').attr('method', 'PUT');
                    $("#name").val(result.data.name);
                    $("#username").val(result.data.username);
                }
            })
        });

        $("#form-edit-profile").on("submit", function(e) {
            e.preventDefault()
            let urlSave = ($("#form-edit-profile").attr('action'))
            let method = ($("#form-edit-profile").attr('method'))

            var formData = new FormData();
            formData.append('name', $("#name").val());
            formData.append('username', $("#username").val());
            formData.append('password', $("#password").val());
            formData.append('avatar', $('#avatar:input[type=file]')[0].files[0]);

            if (method == 'PUT') {
                formData.append('_method', 'PUT');
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
                        text: data.message,
                        icon: 'success',
                    })
                    $("#avatar-sidebar").attr("src", "assets/image/avatar/" + data.avatar);
                    $('#profileEditModal').modal('hide');
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
                        // swal.fire({
                        //     title: 'Error',
                        //     html: html,
                        //     icon: 'warning',
                        // });
                        $("#dokumenFs-validation").html(html)
                        $("#dokumenFs-validation").removeClass("d-none")
                    }
                }
            });
        });

        // show preview foto before upload
        $("#avatar").change(function() {
            const file = this.files[0]
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $("#avatar-sidebar-modal").attr("src", event.target.result)
                }
                reader.readAsDataURL(file)
            }
        })

        // show preview foto before upload
        $("#profile-edit-modal").click(function() {
            let avatar = $("#avatar-sidebar").attr("src")
            $("#avatar-sidebar-modal").attr("src", avatar)
        })
    </script>
</body>

</html>
