<script src="{{ asset('assets/admin-page/admin-lte/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('assets/admin-page/admin-lte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
{{-- <script>
    $.widget.bridge('uibutton', $.ui.button)
</script> --}}
{{-- font awesome  --}}
<script src="https://kit.fontawesome.com/e4d20a5f83.js" crossorigin="anonymous"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/admin-page/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('assets/admin-page/admin-lte/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
{{-- <script src="{{ asset('assets/admin-page/admin-lte/plugins/sparklines/sparkline.js') }}"></script> --}}
<!-- JQVMap -->
<script src="{{ asset('assets/admin-page/admin-lte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('assets/admin-page/admin-lte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('assets/admin-page/admin-lte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('assets/admin-page/admin-lte/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/admin-page/admin-lte/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script
    src="{{ asset('assets/admin-page/admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
</script>
<!-- Summernote -->
<script src="{{ asset('assets/admin-page/admin-lte/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/admin-page/admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}">
</script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/admin-page/admin-lte/dist/js/adminlte.js') }}"></script>
{{-- data tables --}}
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
{{-- select2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{{-- sweet alert --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- leaflet js --}}
<script src="{{ asset('assets/leaflet/js/leaflet.js') }}"></script>
<script src="{{ asset('assets/leaflet/js/leaflet-geoman.min.js') }}"></script>
<script src="{{ asset('assets/dt-picker/jquery.datetimepicker.full.js') }}"></script>

<script>
    $(document).on({
        ajaxStart: function() {
            $("#overlay").fadeIn(300);
        },
        ajaxStop: function() {
            $("#overlay").fadeOut(300);
        },
        ajaxError: function() {
            $("#overlay").fadeOut(300);
        }
    });
</script>

{{-- script for edit profile in navbar --}}

<script>
    // $('#self-edit').on('submit', (e) => {
    //     e.preventDefault()
    //     console.log('self - edit')
    // })
    // ubah tampilan foto
    $("#self-image").change(function() {
        var ext = $('#self-image').val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
            swal.fire({
                title: 'Error',
                html: 'Foto profil pengguna harus file Gambar',
                icon: 'warning',
            })
            $("#self-image").val("")
        } else {
            changeImage(this);
        }
    });

    function changeImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#self-foto').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    $("#self-edit").on("submit", function(e) {
        e.preventDefault();
        id = $("#id-user").val();
        let urlSave = '/admin/user/' + id + '/selfupdate';
        let method = 'PUT';

        var formData = new FormData;

        formData.append('nama_lengkap', $("#self-name").val());
        formData.append('username', $("#self-username").val());
        formData.append('password', $("#self-password-1").val());
        formData.append('password2', $("#self-password-2").val());
        formData.append('image', $('input[type=file]')[0].files[0]);

        if (method == 'PUT') {
            formData.append('_method', 'PUT')
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                // 'Content-Type': 'application/json',
            },
            type: "POST",
            url: urlSave,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $('#modal-form').modal('hide');
                swal.fire({
                    title: 'Berhasil',
                    text: data,
                    icon: 'success',
                }).then(function() {
                    window.location.reload();
                });
            },
            error: (xhr, ajaxOptions, thrownError) => {
                if (xhr.responseJSON.hasOwnProperty('errors')) {
                    var html =
                        "<ul style='justify-content: space-between;'>";
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
                    html += '</ul>';
                    swal.fire({
                        title: 'Error',
                        html: html,
                        icon: 'warning',
                    });
                }
            }
        });
        return false;
    })
</script>

<script>
    $(document).on('click', "#profile-edit-modal", function() {
        $("#profileEditModalLabel").html("").append("Edit Profile");
        $("#name").val("");
        $("#username").val("");
        $("#password").val();
        $("#avatar").val();
        $("#avatar-sidebar-edit").attr("src", $(".avatar-navbar").attr("src"))
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
                // console.log(result);
                let urlUpdate = "{{ route('profile.update', ':id') }}"
                urlUpdate = urlUpdate.replace(':id', id)
                $('#form-edit-profile').attr('action', urlUpdate);
                $('#form-edit-profile').attr('method', 'PUT');
                $("#name").val(result.data.name);
                $("#username").val(result.data.username);
            }
        })
        // console.log(id);
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

        console.log($('#avatar:input[type=file]')[0].files[0]);

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
                    text: data.message,
                    icon: 'success',
                })
                $(".avatar-navbar").attr("src", "assets/image/avatar/" + data.avatar);
                $('#profileEditModal').modal('hide');
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
                    $('#profileEditModal').modal('hide');
                    html += "</ul>";
                    swal.fire({
                        title: 'Error',
                        html: html,
                        icon: 'warning',
                    });
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
                $("#avatar-sidebar-edit").attr("src", event.target.result)
            }
            reader.readAsDataURL(file)
        }
    })
</script>
