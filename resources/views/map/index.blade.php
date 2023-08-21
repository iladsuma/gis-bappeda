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
            font-size: 12px;
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

    {{-- leaflet script --}}
    <script>
        let map = L.map('map', {})
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
            color: "yellow",
            opacity: .75
        }

        let styleKawasanKumuh = {
            color: "white",
            opacity: .50
        }

        let styleKawasanRTLH = {
            color: "cyan",
            opacity: .50
        }

        let styleKemiskinan = {
            color: "red",
            opacity: .50
        }

        let styleStunting = {
            color: "orange",
            opacity: .50
        }


        let sananwetan = new L.GeoJSON.AJAX("assets/leaflet/geojson/sananwetan.geojson", style).addTo(map),
            kepanjenkidul = new L.GeoJSON.AJAX("assets/leaflet/geojson/kepanjenkidul.geojson", style).addTo(map),
            sukorejo = new L.GeoJSON.AJAX("assets/leaflet/geojson/sukorejo.geojson", style).addTo(map)
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

        let layerPerencanaan = L.layerGroup();
        let layerKawasanKumuh = L.layerGroup();
        let layerRtlh = L.layerGroup();
        let layerKemiskinan = L.layerGroup();
        let layerStunting = L.layerGroup();
        let layerSpam = L.layerGroup();
        let layerPdam = L.layerGroup();
        // let sampleLayer = L.layerGroup();

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
        let controlLayer = L.control.groupedLayers(baseLayers, groupedOverlays, {
            collapsed: false,
            exclusiveGroups: ["Data Pendukung"],
            groupCheckboxes: false
        }).addTo(map);

        let sidebar = L.control.sidebar('sidebar', {
            position: 'right'
        }).addTo(map)

        // add control layer to sidebar
        let htmlControlLayer = controlLayer.getContainer();
        $('#layer-data').append(htmlControlLayer);

        // leaflet geoman
        map.pm.addControls({
            position: 'topleft',

        })



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
                    $.each(result.data, function(index, data) {
                        let coordinate = data.coordinate.split(",")
                        let marker = L.marker(coordinate)
                        marker.addTo(layerPerencanaan);
                        layerPerencanaan.addTo(map)
                        markerOnClick(marker, data)
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
                        console.log(result);
                        let polygon = new L.GeoJSON.AJAX("assets/geometry_kelurahan/" + data
                            .kelurahan.geometry, style)
                        if (result.judul == "Kawasan Kumuh") {
                            polygon.addTo(layerKawasanKumuh)
                            layerKawasanKumuh.addTo(map)
                        } else if (result.judul == "RTLH") {
                            polygon.addTo(layerRtlh)
                            layerRtlh.addTo(map)
                        } else if (result.judul == "Lokus Kemiskinan") {
                            polygon.addTo(layerKemiskinan)
                            layerKemiskinan.addTo(map)
                        } else if (result.judul == "Lokus Stunting") {
                            polygon.addTo(layerStunting)
                            layerStunting.addTo(map)
                        }
                        polygonOnClick(polygon, data, result.judul)
                    })
                }
            });
        }

        // function get data for marker and set the content and bind the pop up marker on click
        function markerOnClick(marker, data) {
            console.log(data)
            let content = `<img class="img-fluid" src="{{ asset('assets/foto_lokasi/`+data.foto+`') }}"></img>
                                            <table class="table table-sm table-striped">
                                                <tr>
                                                    <th>Nama</th>
                                                    <td>` + data.nama + `</td>
                                                </tr>
                                                <tr>
                                                    <th>Kecamatan</th>
                                                    <td>` + data.kelurahan.nama + `</td>
                                                </tr>
                                                <tr>
                                                    <th>Kelurahan</th>
                                                    <td>` + data.kelurahan.kecamatan.nama + `</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" colspan="2">
                                                        <a href="#" class="open-modal" data-id="` + data.id + `">
                                                            <i class="fa fa-info-circle"></i>Detail
                                                        </a>
                                                    </td>      
                                                </tr>
                                            </table>`

            marker.on("click", function(e) {
                $(".detail-tab").attr("data-id", data.id)
                if (e.target._popup == undefined) {
                    marker.bindPopup(content).openPopup()
                } else {
                    marker.bindPopup()
                }
            })
        }

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
                        data: 'dokumen_fs',
                        render: function(data) {
                            return `<a href="assets/dokumen_fs/` + data + `" target="_blank" >` +
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
                            return `<a href="assets/dokumen_mp/` + data + `" target="_blank" >` +
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
                            return `<a href="assets/dokumen_ded/` + data + `" target="_blank" >` +
                                data + `</a>`
                        },
                    },
                ]
            })

            $("#modal-detail").modal("show")

        })
    </script>

    {{-- search script --}}
    <script>
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
</body>

</html>
