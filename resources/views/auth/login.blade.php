<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    {{-- CSS --}}
    <style>
        body {
            background-image: url('https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhkojnDvoDZ25oHrTLekmuf9Ywug3vFuwJlrIQoFtLXuzBCgatNzrk3P7cGX3k-lQoMYwhdvNRh8asEQqNc5TVBTsB-ksSG6J62dq6l2z7NieodSPXvF1g4EPdTNaqbFMX9n-4_Iy2NITYXjoJv98WWBAxTscEAxxK5pfGlXq8c-qN2Bo5lXEV-Npl7xQ/s3168/Monumen%20PETA.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            overflow-x: hidden;
        }

        .card-login {
            background: rgba(255, 255, 255, 0.9);
            -webkit-box-shadow: 0px 0px 33px 8px rgba(255, 255, 255, 0.47);
            -moz-box-shadow: 0px 0px 33px 8px rgba(255, 255, 255, 0.47);
            box-shadow: 0px 0px 33px 8px rgba(255, 255, 255, 0.47);
        }

        .logo p {
            font-size: 19px;
            letter-spacing: 1px;
        }

        input[type=text], input[type=password] {
            border: none;
            background: transparent;
            border-bottom: 2px solid gray;
        }

        input[type=text]:focus, input[type=password]:focus {
            border: none;
            background: transparent;
            border-bottom: 2px solid gray;
        }
    </style>

</head>

<body>

    <div class="row d-flex justify-content-center mt-5">
        <div class="col-lg-5">
            <div class="card card-login py-4">
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-10">
                            <div class="d-flex justify-content-between align-items-center logo">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/55/Lambang_Kota_Blitar.png/450px-Lambang_Kota_Blitar.png"
                                    class="mx-2" width="70px">
                                <p class="mx-2">
                                    Badan Perancanaan dan Pembangunan daerah Kota Blitar
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-5">
                        <h3 class="font-weight-bold text-center mb-4">
                            Halaman Login
                        </h3>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-11">
                                    <div class="form-group mb-4">
                                        <div class="d-flex align-items-center">
                                            <h3 class="m-0 p-0 mr-3 text-secondary">
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                            </h3>
                                            <input type="text" id="username" name="login" class="form-control"
                                                placeholder="Masukkan username ..." autofocus required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex align-items-center">
                                            <h3 class="m-0 p-0 mr-3 text-secondary">
                                                <i class="fa fa-lock" aria-hidden="true"></i>
                                            </h3>
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Masukkan password ..." required>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center mt-5">
                                        <button type="submit" class="btn btn-secondary px-5">Masuk Akun <i
                                                class="fa fa-sign-in" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

</body>

</html>
