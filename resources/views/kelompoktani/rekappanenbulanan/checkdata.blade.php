@extends('kelompoktani.temp_kelompok.index')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between text-light">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                <h1 class="teks-manajemen h3 mb-0" style="color: black">Laporan Rekap Panen Bulanan</h1>
            </div>
        </div>
        <a href="/rekap-bulanan/{{ $id_tanggal_panen }}" class="btn btn-primary mb-4">
            <i class="fas fa-arrow-circle-left"></i>
        </a>

        <div class="card w-100" style="overflow: auto; background-color: #D9D9D9">
            <div class="card-body">
                @if (session('success'))
                    <div id="success-alert" class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-sm table-borderless" style="background-color: white; border-radius: 10px">
                    <thead>
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Nama Anggota</th>
                            <th class="text-center" colspan="2">Rotasi 1</th>
                            <th class="text-center" colspan="2">Rotasi 2</th>
                            <th class="text-center" colspan="2">Rotasi 3</th>
                            <th class="text-center" colspan="2">Rotasi 4</th>
                            <th class="text-center" rowspan="2">Total Keseluruhan Tonase</th>
                        </tr>
                        <tr>
                            <th>Total Tonase</th>
                            <th>Aksi</th>
                            <th>Total Tonase</th>
                            <th>Aksi</th>
                            <th>Total Tonase</th>
                            <th>Aksi</th>
                            <th>Total Tonase</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($kelompokData as $key => $kelompok)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $kelompok['nama_anggota'] }}</td>
                                @php
                                    $totalKeseluruhanTonase = 0; // Inisialisasi total keseluruhan tonase
                                @endphp
                                @for ($i = 1; $i <= 4; $i++)
                                    <td>
                                        @if (isset($kelompok['dates'][$i - 1]))
                                            {{ number_format($kelompok['dates'][$i - 1]['total_tonase'], 0, ',') }} Kg
                                        @else
                                            0 Kg
                                        @endif
                                    </td>
                                    <td>
                                        @if (isset($kelompok['dates'][$i - 1]))
                                            <a href="/rekap-bulanan/checkData/update/{{ $kelompok['dates'][$i - 1]['id_data_panen_kelompok'] }}/{{ $id_tanggal_panen }}/{{ $id_tanggal_panen_revisi }}"
                                                class="btn btn-warning my-1 btn-sm">
                                                <i class="far fa-edit"></i>
                                            </a>
                                        @else
                                            <!-- Handle action when data is not available -->
                                        @endif
                                    </td>
                                    @php
                                        if (isset($kelompok['dates'][$i - 1])) {
                                            $totalKeseluruhanTonase += $kelompok['dates'][$i - 1]['total_tonase']; // Menambahkan total tonase per tanggal panen
                                        }
                                    @endphp
                                @endfor
                                <td>
                                    {{ number_format($totalKeseluruhanTonase, 0, ',') }} Kg
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
