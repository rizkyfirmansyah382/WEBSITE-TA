<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Ketelusuran Hasil Pertanian Sawit - KUD Sawit Jaya</title>
    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    @include('umum.temp_umum.css')
</head>

<body>
    {{-- Header --}}
    @include('umum.temp_umum.header')
    {{-- Content --}}
    @yield('content')
    {{-- Footer --}}
    {{-- JavaScript --}}
    @include('umum.temp_umum.javascript')
</body>

</html>
