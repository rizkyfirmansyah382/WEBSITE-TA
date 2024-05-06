@extends('admin.temp_admin.index')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between text-light">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                <h1 class="teks-manajemen h3 mb-0" style="color: black">Tonase Panen Harian</h1>
            </div>
        </div>
        <a href="/tonase-panen-harian" class="btn btn-primary mb-4">
            <i class="fas fa-arrow-circle-left"></i>
        </a>
        <div class="card w-100" style="overflow: auto; background-color: #D9D9D9">
            <div class="card-body">
                <table class="table table-sm table-borderless" style="background-color: white; border-radius: 10px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Petani</th>
                            <th>Tonase Anggota</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalTonase = 0;
                            $totalJanjang = 0;
                        @endphp
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($datapanen as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->nama_anggota }}</td>
                                <td>{{ number_format($item->tonase_anggota) }} Kg</td>
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
