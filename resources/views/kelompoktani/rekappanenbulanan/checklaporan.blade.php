@extends('kelompoktani.temp_kelompok.index')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between text-light">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                <h1 class="teks-manajemen h3 mb-0" style="color: black">Laporan Data Panen</h1>
            </div>
        </div>
        <a href="/rekap-bulanan" class="btn btn-primary mb-4">
            <i class="fas fa-arrow-circle-left"></i>
        </a>

        <div class="card w-100" style="overflow: auto; background-color: #D9D9D9">
            <div class="card-body">
                <table class="table table-sm table-borderless" style="background-color: white; border-radius: 10px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kelompok</th>
                            <th>Total Tonase</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                            $totalTonaseKelompok = 0;
                        @endphp
                        @forelse ($kelompokData as $kelompok)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $kelompok['nama_kelompok'] }}</td>
                                <td>
                                    @php
                                        $totalTonaseDates = array_column($kelompok['dates'], 'total_tonase');
                                        $totalTonase = isset($totalTonaseDates) ? number_format(array_sum($totalTonaseDates)) : 0;
                                    @endphp
                                    {{ $totalTonase }} Kg
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary"
                                        href="/rekap-bulanan/checkData/{{ $id_tanggal_panen }}/{{ implode(',', array_column($kelompok['dates'], 'id_tanggal_panen')) }}">Check
                                        Data</a>
                                </td>
                            </tr>
                            @php
                                $totalTonaseKelompok += array_sum($totalTonaseDates);
                            @endphp
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Data kelompok tidak tersedia</td>
                            </tr>
                        @endforelse
                        <tr>
                            <td colspan="2"><strong>Total Keseluruhan</strong></td>
                            <td><strong>{{ number_format($totalTonaseKelompok) }} Kg</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
