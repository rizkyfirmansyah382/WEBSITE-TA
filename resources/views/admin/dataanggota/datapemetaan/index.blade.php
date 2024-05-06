@extends('admin.temp_admin.index')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between text-light">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="teks-manajemen h3 mb-0" style="color: black">Data Anggota Pemetaan</h1>
            </div>
        </div>

        <div class="card w-100" style="overflow: auto; background-color: #D9D9D9">
            <div class="card-body">
                @if (session('success'))
                    <div id="success-alert" class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div id="error-alert" class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <table class="table table-sm table-borderless" style="background-color: white; border-radius: 10px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Photo</th>
                            <th>Nama Anggota</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat Tinggal</th>
                            <th>Pekerjaan</th>
                            <th>Luas Lahan</th>
                            <th>No Anggota</th>
                            <th>Kelompok</th>
                            <th>Blok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($anggotaterValidasi as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>
                                    @if ($item->photo)
                                        <img src="{{ asset($item->photo) }}" alt="Photo"
                                            style="max-width: 50px; max-height: 50px;">
                                    @else
                                        No Photo
                                    @endif
                                </td>
                                <td>{{ $item->nama_anggota }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->alamat_tinggal }}</td>
                                <td>{{ $item->pekerjaan }}</td>
                                <td>{{ $item->luas_lahan }} Ha</td>
                                <td>{{ $item->no_anggota }}</td>
                                <td>{{ $item->nama_kelompok }}</td>
                                <td>{{ $item->blok }}</td>
                                <td>
                                    <a href="/data-pemetaan/{{ $item->id_anggota_tervalidasi }}"
                                        class="btn btn-primary btn-sm">Tambah Koordinat</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Sembunyikan pesan sukses setelah 3 detik (3000 milidetik)
        setTimeout(function() {
            document.getElementById('success-alert').style.display = 'none';
        }, 3000);
    </script>
@endsection
