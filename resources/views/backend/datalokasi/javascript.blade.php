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

        function callLeaflet() {
            let map = new L.map('modal-map', {
                fullscreenControl: true,
            })
            map.setView([-8.098244, 112.165077], 15);
            // map.addControl(new L.Control.Fullscreen());

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

            let marker = L.marker([-8.098090703999619, 112.16517341741141]).addTo(map)
            let controlLayer = L.control.layers({
                "Google": google,
                "OpenStreet": osm,
                "Satelit": imagery,
            }, null, {
                "collapsed": true
            }).addTo(map)
            // geoman tool
            map.pm.enableGlobalDragMode()

            marker.on("pm:dragend", (e) => {
                console.log(e.layer);
                console.log(e.layer._latlng.lat);
                $("#koordinat").val(e.layer._latlng.lat + "," + e.layer._latlng.lng)

            })

            $('#modal-lokasi-kegiatan').on('shown.bs.modal', function() {
                setTimeout(function() {
                    map.invalidateSize();
                }, 500);
            });
        }

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

        // call modal create / update data lokasi
        $(document).on('click', "#tambah-data", function() {
            $("#lokasi-kegiatan-form").attr("action", "{{ route('data-lokasi.store') }}")
            $("#lokasi-kegiatan-form").attr("method", "POST")
            $("#modal-lokasi-kegiatan").modal("show")
            $("#foto-preview").attr("hidden", true)
            $("#foto-lokasi").val("")
            callLeaflet()
        })

        // submit modal form lokasi-kegiatan
        $("#lokasi-kegiatan-form").on("submit", function(e) {
            e.preventDefault()
            let dataLokasi = new FormData()
            dataLokasi.append("nama_lokasi", $("#nama-lokasi").val())
            dataLokasi.append("kelurahan", $("#kelurahan").val())
            dataLokasi.append("alamat", $("#alamat").val())
            dataLokasi.append("coordinate", $("#koordinat").val())
            dataLokasi.append("coordinate", $("#koordinat").val())
            dataLokasi.append("foto", $("#foto-lokasi")[0].files[0])

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
                    $('#modalDokumenFS').modal('hide');
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
                        $("#lokasi-validation").html(html)
                        $("#lokasi-validation").removeClass("d-none")
                    }
                }
            });
        })
    });
</script>
