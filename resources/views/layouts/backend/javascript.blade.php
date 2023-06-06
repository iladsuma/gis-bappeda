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
