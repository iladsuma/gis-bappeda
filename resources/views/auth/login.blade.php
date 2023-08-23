<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;700&display=swap" rel="stylesheet">

    {{-- Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    {{-- CSS --}}
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
        }

        .card-login {
            -webkit-box-shadow: 0px 0px 21px 2px rgba(0, 0, 0, 0.09);
            -moz-box-shadow: 0px 0px 21px 2px rgba(0, 0, 0, 0.09);
            box-shadow: 0px 0px 21px 2px rgba(0, 0, 0, 0.09);
            background-color: #ffffff;
        }

        .hero-image {
            background: url('https://img.rawpixel.com/s3fs-private/rawpixel_images/website_content/rm222-mind-16_1.jpg?w=800&dpr=1&fit=default&crop=default&q=65&vib=3&con=3&usm=15&bg=F4F4F3&ixlib=js-2.2.1&s=1c53e59a7b21c1ffee85bc36a3837392');
            background-size: cover;
            background-position-x: -150px;
        }

        .hero-image div {
            background-color: rgba(255, 255, 255, 0.3);
            word-spacing: 10px;
        }

        .hero-image img {
            text-shadow:
                3px 3px 0 #fff,
                -1px -1px 0 #fff,
                1px -1px 0 #fff,
                -1px 1px 0 #fff,
                1px 1px 0 #fff;
        }

        .hero-image h3 {
            font-weight: 900;
            text-shadow:
                3px 3px 0 #fff,
                -1px -1px 0 #fff,
                1px -1px 0 #fff,
                -1px 1px 0 #fff,
                1px 1px 0 #fff;
        }

        .card-login h1 {
            color: #0095D6;
        }
    </style>

</head>

<body class="bg-light">

    <div class="container">

        <div class="row d-flex justify-content-center mt-5">
            <div class="col-lg-10">
                <div class="row card-login">
                    <div class="col-lg-6 hero-image d-flex justify-content-center align-items-center">
                        <div class="col-lg-10 py-3 rounded-sm">
                            <span class="d-flex justify-content-center mt-3 mb-4" style="opacity: 1.0;">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/5/55/Lambang_Kota_Blitar.png"
                                    alt="" class="col-lg-3">
                            </span>
                            <h3 class="text-center text-dark">
                                ( BAPPEDA )
                                <br>
                                Badan Perencanaan dan Pembangunan Daerah
                                <br>
                                Kota Blitar
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6 p-5">
                        <form action="{{ route('login') }}" method="POST" class="px-5" style="border: 2px solid #B8EEFF; border-radius: 20px;">
                            @csrf
                            <h1 class="text-center mb-3 mt-4 font-weight-bold">Login</h1>
                            <div class="mb-3">
                                <label for="login" class="form-label">Username</label>
                                <input type="text" name="login" placeholder="Masukkan username ..."
                                    class="form-control" autofocus required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" placeholder="Masukkan password ..."
                                    class="form-control" autofocus required>
                            </div>
                            <div class="mb-5 mt-5 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary w-100 font-weight-bold">Masuk Akun <i class="fa fa-sign-in"
                                        aria-hidden="true"></i></button>
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

    {{-- font awesome  --}}
    <script src="https://kit.fontawesome.com/e4d20a5f83.js" crossorigin="anonymous"></script>

</body>

</html>
