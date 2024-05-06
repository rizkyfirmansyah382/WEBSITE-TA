@extends('admin.temp_admin.index')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between text-light">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="teks-manajemen h3 mb-0" style="color: black">Data Anggota Tervalidasi</h1>
            </div>
            <a href="/anggota-tervalidasi/create" class="btn btn-primary btn-sm mb-4">Tambah Data</a>
        </div>

        <div class="card w-100 mb-4" style="overflow: auto; background-color: #D9D9D9">
            <div class="card-body mt-3">
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
                            <th>NIK</th>
                            <th>Tgl Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat Tinggal</th>
                            <th>Pekerjaan</th>
                            <th>Tanggal Masuk</th>
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
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->tgl_lahir->format('d F Y') }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->alamat_tinggal }}</td>
                                <td>{{ $item->pekerjaan }}</td>
                                <td>{{ $item->tgl_masuk_anggota->format('d F Y') }}</td>
                                <td>{{ $item->luas_lahan }} Ha</td>
                                <td>{{ $item->no_anggota }}</td>
                                <td>{{ $item->nama_kelompok }}</td>
                                <td>{{ $item->blok }}</td>
                                <td>
                                    <a href="/anggota-tervalidasi/{{ $item->id_anggota_tervalidasi }}/update"
                                        class="btn btn-warning my-1 btn-sm">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="/anggota-tervalidasi/{{ $item->id_anggota_tervalidasi }}/delete"
                                        class="btn btn-danger my-1 btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
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
