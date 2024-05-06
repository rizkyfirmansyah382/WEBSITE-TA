{{-- Header --}}
<nav class="navbar navbar-expand-lg" style="font-weight: bolder; background-color: #006F1F">
    <div class="container-fluid ps-5 pe-5">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" width="=50" height="50"
                class="d-inline-block align-text-top">
        </a>
        <span class="navbar-brand text-light">KUD Sawit Jaya</span>
        <a href="" class="navbar-toggler btn btn-light" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fas fa-sliders-h" style="color: white"></i>
            {{-- <span class="navbar-toggler-icon" style="color: white"></span> --}}

        </a>
        {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="color: white"></span>
        </button> --}}
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
