<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gis Bappeda</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/leaflet/css/leaflet-sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/leaflet/css/leaflet.groupedlayercontrol.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/leaflet/css/leaflet-geoman.css') }}">

    <style>
        html,
        body .map-container {
            height: 100%;
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


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/e4d20a5f83.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="{{ asset('assets/leaflet/js/leaflet-sidebar.js') }}"></script>
    <script src="{{ asset('assets/leaflet/js/leaflet.groupedlayercontrol.js') }}"></script>
    <script src="{{ asset('assets/leaflet/js/leaflet.ajax.js') }}"></script>
    <script src="{{ asset('assets/leaflet/js/leaflet-geoman.min.js') }}"></script>

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

        let sampleLayer = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                maxZoom: 18,
            })

        let baseLayers = {
            "Citra Satelit": imagery,
            "Google": google,
            "Open Street Map": osm,
        }

        let sananwetan = new L.GeoJSON.AJAX("assets/leaflet/geojson/sananwetan.geojson").addTo(map),
            kepanjenkidul = new L.GeoJSON.AJAX("assets/leaflet/geojson/kepanjenkidul.geojson").addTo(map),
            sukorejo = new L.GeoJSON.AJAX("assets/leaflet/geojson/sukorejo.geojson").addTo(map)
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
        }).addTo(map);
        let groupedOverlays = {
            "Peta Tematik ": {
                "Kecamatan Sananwetan": sananwetan,
                "Kecamatan Kepanjenkidul": kepanjenkidul,
                "Kecamatan Sukorejo": sukorejo,
                "Tata Ruang (RDTR)": rdtr,
            },
            "Peta Perencanaan": {
                "Dokumen Perencanaan": sampleLayer
            },
            "Data Pendukung": {
                "Kawasan Kumuh": sampleLayer,
                "Kawasan RTLH": sampleLayer,
                "Lokus Kemiskinan": sampleLayer,
                "Lokus Stunting": sampleLayer,
                "Jaringan Spam": sampleLayer,
                "Jaringan Pipa PDAM": sampleLayer,
            }
        };



        let controlLayer = L.control.groupedLayers(baseLayers, groupedOverlays, {
            collapsed: false,
            exclusiveGroups: ["Data Pendukung"],
            groupCheckboxes: false
        }).addTo(map);



        let sidebar = L.control.sidebar('sidebar', {
            position: 'right'
        }).addTo(map)

        let htmlObject = controlLayer.getContainer();
        let parent = document.getElementById('home');

        function setParentLayer(element, newParent) {
            newParent.appendChild(element);
        }
        setParentLayer(htmlObject, parent);



        // leaflet geoman
        map.pm.addControls({
            position: 'topleft',

        })
    </script>
</body>

</html>
