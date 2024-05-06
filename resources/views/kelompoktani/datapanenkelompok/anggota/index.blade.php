@extends('kelompoktani.temp_kelompok.index')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between text-light">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                <h1 class="teks-manajemen h3 mb-0" style="color: black">Data Panen Anggota</h1>
            </div>
        </div>
        <div class="d-flex justify-content-between mb-4">
            <a href="/tanggal-panen-kelompok" class="btn btn-primary btn-sm">
                <i class="fas fa-arrow-circle-left"></i>
            </a>
            <a href="/data-panen-kelompok/create/{{ $id_tanggal_panen }}" class="btn btn-primary btn-sm">Tambah Data</a>
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
                            <th>Nama Anggota</th>
                            <th>Tonase Anggota</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalTonase = 0;
                        @endphp
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($datapanen as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->nama_anggota }}</td>
                                <td>{{ number_format($item->tonase_anggota) }} Kg</td>
                                <td>
                                    <a href="/data-panen-kelompok/{{ $item->id_tanggal_panen }}/{{ $item->id_anggota_tervalidasi }}/update"
                                        class="btn btn-warning my-1 btn-sm">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="/data-panen-kelompok/{{ $item->id_tanggal_panen }}/{{ $item->id_anggota_tervalidasi }}/delete"
                                        class="btn btn-danger my-1 btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @php
                                $totalTonase += $item->tonase_anggota;
                            @endphp
                        @endforeach
                        <tr>
                            <td colspan="2"><strong>Total Keseluruhan</strong></td>
                            <td><strong>{{ number_format($totalTonase) }} Kg</strong></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
