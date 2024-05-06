@extends('admin.temp_admin.index')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between text-light">
            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                <h1 class="teks-manajemen h3 mb-0" style="color: black">Selisih Hasil Panen Dengan PKS</h1>
            </div>
        </div>

        <div class="d-sm-flex align-items-center justify-content-between text-light">
            <a href="/selisih-panen-harian/pilih-tanggal/{{ $id_kelompok }}" class="btn btn-primary mb-4">
                <i class="fas fa-arrow-circle-left"></i>
            </a>
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModalCenter">
                <i class="fas fa-file-download"></i> Download
            </button>

            <!-- Modal-->
            <div class="modal fade" id="exampleModalCenter" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="staticBackdrop" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="card text-center" style="color: black">
                            <div class="card-header text-dark">
                                Silahkan pilih download :
                            </div>
                            <div class="card-body">
                                <a href="/selisih-panen-harian/downloadExcel/{{ $id_tanggal_panen }}/{{ $id_kelompok }}"
                                    class="btn mb-4 text-white justify-content-end" style="background-color: #006F1F">
                                    <i class="fas fa-file-excel"></i> Download Excel
                                </a>
                                <a href="/selisih-panen-harian/download/{{ $id_tanggal_panen }}/{{ $id_kelompok }}"
                                    class="btn mb-4 text-white" style="background-color: #006F1F">
                                    <i class="fas fa-file-pdf"></i> Download PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card w-100 mb-2" style="overflow: auto; background-color: #D9D9D9">
            <div class="card-body">
                <table class="table table-sm table-borderless mb-2" style="background-color: white; border-radius: 10px">
                    <thead>
                        <tr>
                            <td colspan="2" class="text-center">Daftar Anggota Kelompok Tani</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">Selisih Hasil Panen Lapangan Dengan Pabrik Kelapa Sawit
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">Periode : {{ $tanggal_panen->format('d F Y') }}</td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-sm table-borderless" style="background-color: white; border-radius: 10px">
                    <thead>
                        <tr>
                            <td>Kelompok Tani</td>
                            <td>: {{ $nama_kelompok }}</td>
                        </tr>
                        <tr>
                            <td>UUO</td>
                            @auth
                                <td>: {{ auth()->user()->name }}</td>
                            @endauth
                        </tr>
                        <tr>
                            <td>Jumlah Anggota</td>
                            <td>: {{ count($tonasepanen) }} KK</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>


        <div class="card w-100" style="overflow: auto; background-color: #D9D9D9">
            <div class="card-body">
                <table class="table table-sm table-borderless" style="background-color: white; border-radius: 10px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Anggota</th>
                            <th>Tonase</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalTonase = 0;
                            $totalPks = 0;
                            $selisih = 0;
                            $no = 1;
                        @endphp
                        @foreach ($tonasepanen as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->nama_anggota }}</td>
                                <td>{{ number_format($item->tonase_anggota) }} Kg</td>
                            </tr>
                            @php
                                $totalTonase += $item->tonase_anggota;
                                $totalPks += $item->netto_bersih;
                            @endphp
                        @endforeach
                        @foreach ($nettobersih as $item)
                            @php
                                $totalPks += $item->netto_bersih;
                            @endphp
                        @endforeach
                        @php
                            $selisih = $totalPks - $totalTonase;
                        @endphp
                        <tr>
                            <td colspan="2"><strong>Total Keseluruhan Lapangan</strong></td>
                            <td><strong>{{ number_format($totalTonase) }} Kg</strong></td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>Total Keseluruhan PKS</strong></td>
                            <td><strong>{{ number_format($totalPks) }} Kg</strong></td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>Selisih</strong></td>
                            <td><strong>{{ number_format($selisih) }} Kg</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
