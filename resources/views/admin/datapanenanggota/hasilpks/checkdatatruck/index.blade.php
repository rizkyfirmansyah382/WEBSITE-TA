@extends('admin.temp_admin.index')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between text-light">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                <h1 class="teks-manajemen h3 mb-0" style="color: black">Data Surat Perintah Bongkar</h1>
            </div>
        </div>
        <a href="/hasil-pks-harian" class="btn btn-primary mb-4">
            <i class="fas fa-arrow-circle-left"></i>
        </a>
        <div class="card w-100" style="overflow: auto; background-color: #D9D9D9">
            <div class="card-body">
                <table class="table table-sm table-borderless" style="background-color: white; border-radius: 10px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kelompok</th>
                            <th>Sopir</th>
                            <th>Kendaraan</th>
                            <th>No SPB</th>
                            <th>Total Janjang</th>
                            <th>Tujuan PKS</th>
                            <th>Input Hasil PKS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                            $totalJanjang = 0;
                        @endphp
                        @foreach ($dataspb as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->nama_kelompok }}</td>
                                <td>{{ $item->nama_sopir }}</td>
                                <td>{{ $item->no_polisi }}</td>
                                <td>{{ $item->no_spb }}</td>
                                <td>{{ $item->total_janjang }} Janjang</td>
                                <td>{{ $item->tujuan_pks }}</td>
                                <td><a href="/input-hasil-pks/{{ $item->id_data_spb }}/{{ $item->id_tanggal_panen }}"
                                        class="btn btn-sm btn-primary">Input
                                        Hasil
                                        PKS</a>
                                </td>
                            </tr>
                            @php
                                $totalJanjang += $item->total_janjang;
                            @endphp
                        @endforeach
                        <tr>
                            <td colspan="5"><strong>Total Keseluruhan</strong></td>
                            <td><strong>{{ number_format($totalJanjang) }} Janjang</strong></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
