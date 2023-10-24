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
    // leaflet for add coordinate
    let map = new L.map('modal-map', {
        fullscreenControl: true,
    })

    map.setView([-8.098244, 112.165077], 13);

    let google = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    })

    let imagery = L.tileLayer(
        'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            maxZoom: 18,
        }).addTo(map);

    let osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    })

    var drawnLayer
    let controlLayer = L.control.layers({
        "Google": google,
        "OpenStreet": osm,
        "Satelit": imagery,
    }, null, {
        "collapsed": true
    }).addTo(map)


    let geoJson = new L.geoJson()

    function getGeoJson() {
        let url = "{{ route('data-jaringan-pipa-pdam.loadgeojson') }}";
        $.get(url, function(data) {
            console.log(data);
            let pathFileGeoJSON = "assets/jaringan_pdam/" + data;
            let jaringanPdam = new L.GeoJSON.AJAX(pathFileGeoJSON, {
                color: "#51dce0",
                opacity: 2,
                weight: 1.5
            })
            jaringanPdam.addTo(geoJson)
            geoJson.addTo(map)
        });
    }
    getGeoJson();

    $('#pipa-pdam-form').on("submit", function(e) {
        e.preventDefault()
        console.log('tes');
        let id = "1"
        let urlSave = ("{{ route('data-jaringan-pipa-pdam.update', ':id') }}")
        let method = ("PUT")

        var formData = new FormData();
        formData.append('file-jaringan-pipa-pdam', $('#file-jaringan-pipa-pdam:input[type=file]')[0].files[0]);

        if (method == 'PUT') {
            formData.append('_method', 'PUT');
        }

        console.log(formData);

        console.log($('#file-jaringan-pipa-pdam:input[type=file]')[0].files[0]);

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
                    geoJson.clearLayers()
                    getGeoJson();
                    $('#btn-container-cancel-map').addClass('d-none')
                    $('#file-jaringan-pipa-pdam').val("");
                });

            },
            error: (xhr, ajaxOptions, thrownError) => {
                console.log(xhr.responseJSON.errors)
                if (xhr.responseJSON.hasOwnProperty('errors')) {
                    var html =
                        "<ul style=justify-content: space-between;'>";
                    var txt = '';
                    for (item in xhr.responseJSON.errors) {
                        if (xhr.responseJSON.errors[item].length) {
                            txt = xhr.responseJSON.errors[item];
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
                    swal.fire({
                        title: 'Error',
                        html: txt,
                        icon: 'warning',
                    }).then(function() {
                        geoJson.clearLayers()
                        getGeoJson();
                        $('#file-jaringan-pipa-pdam').val("");
                    });
                }
            }
        });
    })

    $("#file-jaringan-pipa-pdam").change(function() {
        const file = this.files[0]
        if (file) {
            let reader = new FileReader();
            reader.onload = function(event) {
                // $("#avatar-sidebar-modal").attr("src", event.target.result)
                console.log(event.target.result);
                geoJson.clearLayers()
                let pathFileGeoJSON = event.target.result;
                let jaringanPdam = new L.GeoJSON.AJAX(pathFileGeoJSON, {
                    color: "#51dce0",
                    opacity: 2,
                    weight: 1.5
                })
                jaringanPdam.addTo(geoJson)
                geoJson.addTo(map)
            }
            reader.readAsDataURL(file)
        }
        $('#btn-container-cancel-map').removeClass('d-none')
    })

    $('#cancel-change-map').on("click", function() {
        geoJson.clearLayers()
        getGeoJson();
        $('#btn-container-cancel-map').addClass('d-none')
        $('#file-jaringan-pipa-pdam').val("");
    });
</script>
