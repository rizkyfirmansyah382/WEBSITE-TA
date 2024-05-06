@extends('admin.temp_admin.index')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between text-light">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="teks-manajemen h3 mb-0" style="color: black">Tonase Panen Harian</h1>
            </div>
        </div>

        <div class="card w-100" style="overflow: auto; background-color: #D9D9D9">
            <div class="card-body">
                <table class="table table-sm table-borderless" style="background-color: white; border-radius: 10px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kelompok</th>
                            <th>Tanggal Panen</th>
                            <th>Anggota</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = ($tanggalpanen->currentPage() - 1) * $tanggalpanen->perPage() + 1;
                        @endphp
                        @foreach ($tanggalpanen as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->nama_kelompok }}</td>
                                <td>{{ $item->tgl_panen->format('d F Y') }}</td>
                                <td>
                                    <a href="/lihat-tonase/{{ $item->id_tanggal_panen }}"
                                        class="btn btn-primary btn-sm">Lihat Tonase</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {{ $tanggalpanen->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
