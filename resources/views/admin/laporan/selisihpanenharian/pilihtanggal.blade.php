@extends('admin.temp_admin.index')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between text-light">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                <h1 class="teks-manajemen h3 mb-0" style="color: black">Silahkan check selisih</h1>
            </div>
        </div>
        <a href="/selisih-panen-harian" class="btn btn-primary mb-4">
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
                        @foreach ($tanggalpanen as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->tgl_panen->format('d F Y') }}</td>
                                <td>
                                    <a href="/selisih-panen-harian/check-selisih/{{ $item->id_tanggal_panen }}/{{ $item->id_kelompok }}"
                                        class="btn btn-primary btn-sm">Check Selisih</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
