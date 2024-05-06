@extends('admin.temp_admin.index')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between text-light">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="teks-manajemen h3 mb-0" style="color: black">Data Anggota Lama</h1>
            </div>
        </div>

        <div class="card w-100" style="overflow: auto; background-color: #D9D9D9">
            <div class="card-body">
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
                            <th>Tanggal Keluar</th>
                            <th>No Anggota</th>
                            <th>Kelompok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($anggotalama as $item)
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

                                <td>{{ $item->nama_anggota_lama }}</td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->tanggal_lahir->format('d F Y') }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->pekerjaan }}</td>
                                <td>{{ $item->tanggal_keluar->format('d F Y') }}</td>
                                <td>{{ $item->no_anggota }}</td>
                                <td>{{ $item->nama_kelompok }}</td>
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
