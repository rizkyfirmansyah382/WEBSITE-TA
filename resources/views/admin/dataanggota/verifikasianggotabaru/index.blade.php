@extends('admin.temp_admin.index')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between text-light">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="teks-manajemen h3 mb-0" style="color: black">Daftar Anggota Baru</h1>
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
                            <th>Kartu Keluarga</th>
                            <th>Sertifikat Tanah</th>
                            <th>Surat Jual Beli</th>
                            <th>Nama Anggota Lama</th>
                            <th>Kelompok</th>
                            <th>Nama Anggota Baru</th>
                            <th>NIK</th>
                            <th>Tgl Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat Tinggal</th>
                            <th>Pekerjaan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($anggotabaru as $item)
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
                                <!-- Tambahkan tombol untuk menampilkan file PDF -->
                                @foreach (['KkPdf', 'SertifPdf', 'JBPdf'] as $fileType)
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#fileModal{{ $item->id_daftar_anggota_baru }}_{{ $fileType }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <div class="modal fade"
                                            id="fileModal{{ $item->id_daftar_anggota_baru }}_{{ $fileType }}"
                                            tabindex="-1"
                                            aria-labelledby="fileModalLabel{{ $item->id_daftar_anggota_baru }}_{{ $fileType }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="fileModalLabel{{ $item->id_daftar_anggota_baru }}_{{ $fileType }}">
                                                            File PDF</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <embed src="{{ asset($item->$fileType) }}" type="application/pdf"
                                                            width="100%" height="600px" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                @endforeach
                                <!-- Akhir tambahan kolom -->
                                <td>{{ $item->nama_anggota }}</td>
                                <td>{{ $item->nama_kelompok }}</td>
                                <td>{{ $item->nama_anggota_baru }}</td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->tanggal_lahir->format('d F Y') }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->pekerjaan }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <a href="/verifikasi-anggota-baru/{{ $item->id_anggota_tervalidasi }}/{{ $item->id_daftar_anggota_baru }}/verifikasi"
                                        class="btn btn-warning my-1 btn-sm">
                                        Verifikasi
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
