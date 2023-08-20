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

        let tesMarker = L.marker([-8.098244, 112.165077]).addTo(map)
        tesMarker.on("click", function() {
            // var popup = L
            //     .popup()
            //     .setContent("sasa")

            tesMarker.bindPopup("sasa")
        })

        let baseLayers = {
            "Satelite": imagery,
            "Google": google,
            "OpenStreet": osm,
        }

        let style = {
            color: "yellow",
            opacity: .75
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

        let voidPerencanaan = L.layerGroup();
        let perencanaan = L.layerGroup();
        let voidKumuh = L.layerGroup();
        let voidRtlh = L.layerGroup();
        let voidKemiskinan = L.layerGroup();
        let voidStunting = L.layerGroup();
        let voidSpam = L.layerGroup();
        let voidPdam = L.layerGroup();
        // let sampleLayer = L.layerGroup();

        let groupedOverlays = {
            "Peta Tematik ": {
                "Kecamatan Sananwetan": sananwetan,
                "Kecamatan Kepanjenkidul": kepanjenkidul,
                "Kecamatan Sukorejo": sukorejo,
                "Tata Ruang (RDTR)": rdtr,
            },
            "Peta Perencanaan": {
                "Dokumen Perencanaan": voidPerencanaan
            },
            "Data Pendukung": {
                "Kawasan Kumuh": voidKumuh,
                "Kawasan RTLH": voidRtlh,
                "Lokus Kemiskinan": voidKemiskinan,
                "Lokus Stunting": voidStunting,
                "Jaringan Spam": voidSpam,
                "Jaringan Pipa PDAM": voidPdam,
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
                voidPerencanaan.clearLayers()
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    type: "GET",
                    url: "{{ route('map.lokasi-all') }}",
                    dataType: "json",
                    success: function(result) {
                        $.each(result.data, function(index, data) {
                            let coordinate = data.coordinate.split(",")
                            let marker = L.marker(coordinate)
                            marker.addTo(voidPerencanaan);
                            voidPerencanaan.addTo(map)
                            markerOnclik(marker, data)
                        })
                    }
                });
            }
        })


        // function marker form ajax add the content and bind the pop up
        function markerOnclik(marker, data) {
            console.log(data)
            let content = `<img class="img-fluid" src="{{ asset('assets/foto_lokasi/`+data.foto+`') }}"></img>
                                            <table class="table table-sm table-bordered">
                                                <tr>
                                                    <th>Nama</th>
                                                    <td>` + data.nama + `</th>
                                                </tr>
                                                <tr>
                                                    <th>Kecamatan</th>
                                                    <td>` + data.kelurahan.nama + `</th>
                                                </tr>
                                                <tr>
                                                    <th>Kelurahan</th>
                                                    <td>` + data.kelurahan.kecamatan.nama + `</th>
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

        // open the modal of detail marker
        $(document).on("click", ".open-modal", function() {

            if ($.fn.DataTable.isDataTable('#table-fs')) {
                // tableFs.clear()
                $('#table-fs').DataTable().destroy()
            }

            let id = $(this).data("id")
            alert(id)
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
                retrieve: true,
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
