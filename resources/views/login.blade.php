<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Ketelusuran Hasil Pertanian Sawit - KUD Sawit Jaya</title>
    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    {{-- Bosstrap 5.3 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <Style>
        /* CSS untuk tampilan desktop */
        @media screen and (min-width: 768px) {
            body {
                background-image: url("{{ asset('assets/images/kud.jpeg') }}");
                background-repeat: no-repeat;
                background-size: cover;
            }
        }

        /* CSS untuk tampilan mobile */
        @media screen and (max-width: 767px) {
            body {
                background-image: url("{{ asset('assets/images/kud.jpeg') }}");
                background-repeat: no-repeat;
                background-size: cover;
            }
        }
    </Style>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('asset_admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('asset_admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body>
    {{-- Header --}}
    <nav class="navbar navbar-expand-lg" style="font-weight: bolder; background-color: #006F1F">
        <div class="container-fluid ps-5 pe-5">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" width="=50" height="50"
                    class="d-inline-block align-text-top">
            </a>
            <span class="navbar-brand text-light">KUD Sawit Jaya</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-sliders-h" style="color: white"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="/">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="/pemetaan">Pemetaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="/pilih-hak-akses">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    {{-- Content --}}
    <div class="bg-gambar">
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center ">
                <div class="col-xl-5 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0" style="background-color: #D9D9D9">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <div class="card mb-5">
                                                <h1 class="font-weight-bold">Selamat Datang</h1>
                                            </div>
                                        </div>
                                        <form action="" method="POST">
                                            @csrf
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $item)
                                                            <li class="d-flex justify-content-start">{{ $item }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <input type="username" name="username"
                                                    class="form-control form-control-user"
                                                    placeholder="Masukkan Username Anda" value="{{ old('username') }}"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password"
                                                    placeholder="Masukkan Password Anda"
                                                    class="form-control form-control-user">
                                            </div>
                                            <br>
                                            <center>
                                                <button class="btn btn-primary" type="submit"
                                                    name="submit">Login</button>
                                            </center>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="fixed-bottom pt-2" style="background-color: #006F1F">
        <center>
            <p class="font-weight-bold text-light">&copy; 2023 KUD Sawit Jaya x Rizky Firmansyah x Romi Irawan.</p>
        </center>
    </div>
    {{-- JS Boostrap 5.3 --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('asset_admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('asset_admin/js/sb-admin-2.min.js') }}"></script>
</body>

</html>
