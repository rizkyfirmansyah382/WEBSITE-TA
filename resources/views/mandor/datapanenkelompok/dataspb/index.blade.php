@extends('mandor.temp_mandor.index')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between text-light">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                <h1 class="teks-manajemen h3 mb-0" style="color: black">Data Surat Perintah Bongkar</h1>
            </div>
        </div>
        <div class="d-flex justify-content-between mb-4">
            <a href="/tanggal-panen-kelompok-mandor" class="btn btn-primary">
                <i class="fas fa-arrow-circle-left"></i>
            </a>
            <a href="/data-spb/create/{{ $id_tanggal_panen }}" class="btn btn-sm btn-primary">Tambah
                Data</a>
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
                            <th>Kelompok</th>
                            <th>Sopir</th>
                            <th>Kendaraan</th>
                            <th>Blok</th>
                            <th>No SPB</th>
                            <th>Total Janjang</th>
                            <th>Tujuan PKS</th>
                            <th>Aksi</th>
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
                                <td>{{ $item->blok }}</td>
                                <td>{{ $item->no_spb }}</td>
                                <td>{{ $item->total_janjang }} Janjang</td>
                                <td>{{ $item->tujuan_pks }}</td>
                                <td>
                                    <a href="/data-spb/{{ $item->id_tanggal_panen }}/{{ $item->id_data_spb }}/update"
                                        class="btn btn-warning my-1 btn-sm">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="/data-spb/{{ $item->id_tanggal_panen }}/{{ $item->id_data_spb }}/delete"
                                        class="btn btn-danger my-1 btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @php
                                $totalJanjang += $item->total_janjang;
                            @endphp
                        @endforeach
                        <tr>
                            <td colspan="6"><strong>Total Keseluruhan</strong></td>
                            <td><strong>{{ number_format($totalJanjang) }} Janjang</strong></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
