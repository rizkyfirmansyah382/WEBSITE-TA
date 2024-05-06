@extends('superadmin.temp_superadmin.index')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between text-light">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                <h1 class="teks-manajemen h3 mb-0" style="color: black">Silahkan check laporan</h1>
            </div>
        </div>
        <a href="/laporan-panen-uuo" class="btn btn-primary mb-4">
            <i class="fas fa-arrow-circle-left"></i>
        </a>

        <div class="card w-100" style="overflow: auto; background-color: #D9D9D9">
            <div class="card-body">
                <table class="table table-sm table-borderless" style="background-color: white; border-radius: 10px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Bulan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($result as $bulan)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $bulan['bulan_tahun'] }}</td>
                                <td>
                                    <a href="/laporan-panen-uuo/pilih-bulan/checkLaporan/{{ implode(',', $bulan['id_tanggal_panen']) }}"
                                        class="btn btn-primary btn-sm">Check Laporan</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {{ $bulanpanen->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
