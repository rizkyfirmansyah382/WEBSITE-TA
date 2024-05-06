@extends('kelompoktani.temp_kelompok.index')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between text-light">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="teks-manajemen h3 mb-0" style="color: black">Daftar Anggota Baru</h1>
            </div>
            <a href="/daftar-anggota-baru/create" class="btn btn-primary btn-sm mb-4">Tambah Data</a>
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
                            <th>Kelompok</th>
                            <th>Nama Anggota Lama</th>
                            <th>Nama Anggota Baru</th>
                            <th>NIK</th>
                            <th>Alamat</th>
                            <th>Pekerjaan</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
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
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#fileModal{{ $item->id_daftar_anggota_baru }}_KkPdf">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <div class="modal fade" id="fileModal{{ $item->id_daftar_anggota_baru }}_KkPdf"
                                        tabindex="-1"
                                        aria-labelledby="fileModalLabel{{ $item->id_daftar_anggota_baru }}_KkPdf"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="fileModalLabel{{ $item->id_daftar_anggota_baru }}_KkPdf">
                                                        Kartu Keluarga PDF
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <embed src="{{ asset($item->KkPdf) }}" type="application/pdf"
                                                        width="100%" height="600px" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <!-- Ulangi proses di atas untuk file Sertifikat Tanah dan Surat Jual Beli -->
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#fileModal{{ $item->id_daftar_anggota_baru }}_SertifPdf">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <div class="modal fade" id="fileModal{{ $item->id_daftar_anggota_baru }}_SertifPdf"
                                        tabindex="-1"
                                        aria-labelledby="fileModalLabel{{ $item->id_daftar_anggota_baru }}_SertifPdf"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="fileModalLabel{{ $item->id_daftar_anggota_baru }}_SertifPdf">
                                                        Sertifikat Tanah PDF
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <embed src="{{ asset($item->SertifPdf) }}" type="application/pdf"
                                                        width="100%" height="600px" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#fileModal{{ $item->id_daftar_anggota_baru }}_JBPdf">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <div class="modal fade" id="fileModal{{ $item->id_daftar_anggota_baru }}_JBPdf"
                                        tabindex="-1"
                                        aria-labelledby="fileModalLabel{{ $item->id_daftar_anggota_baru }}_JBPdf"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="fileModalLabel{{ $item->id_daftar_anggota_baru }}_JBPdf">
                                                        Surat Jual Beli PDF
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <embed src="{{ asset($item->JBPdf) }}" type="application/pdf"
                                                        width="100%" height="600px" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>









                                {{-- <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#fileModal{{ $item->id }}_{{ $fileType }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <div class="modal fade" id="fileModal{{ $item->id }}_{{ $fileType }}"
                                        tabindex="-1"
                                        aria-labelledby="fileModalLabel{{ $item->id }}_{{ $fileType }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="fileModalLabel{{ $item->id }}_{{ $fileType }}">
                                                    </h5>
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
                                </td> --}}


                                <td>{{ $item->nama_kelompok }}</td>
                                <td>{{ $item->nama_anggota }}</td>
                                <td>{{ $item->nama_anggota_baru }}</td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->pekerjaan }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->tanggal_lahir->format('d F Y') }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <a href="/daftar-anggota-baru/{{ $item->id_daftar_anggota_baru }}/update"
                                        class="btn btn-warning my-1 btn-sm">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="/daftar-anggota-baru/{{ $item->id_daftar_anggota_baru }}/delete"
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
@endsection
