@extends('admin.temp_admin.index')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between text-light">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                <h1 class="teks-manajemen h3 mb-0" style="color: black">Check Laporan</h1>
            </div>
        </div>

        <div class="d-sm-flex align-items-center justify-content-between text-light">
            <a href="/laporan-panen-anggota-kelompok/pilih-bulan/{{ $id_kelompok }}" class="btn btn-primary mb-4">
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
                                <a href="{{ url('/admin/laporan/downloadExcel/' . $id_kelompok . '/' . urlencode($periodeBulan) . '/' . $periodeTahun) }}"
                                    class="btn mb-4 text-white justify-content-end" style="background-color: #006F1F">
                                    <i class="fas fa-file-excel"></i> Download Excel
                                </a>
                                <a href="{{ url('/admin/laporan/download/' . $id_kelompok . '/' . urlencode($periodeBulan) . '/' . $periodeTahun) }}"
                                    class="btn mb-4 text-white" style="background-color: #006F1F">
                                    <i class="fas fa-file-pdf"></i> Download PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-sm-flex align-items-center justify-content-between text-light">


        </div>


        <div class="card w-100 mb-2" style="overflow: auto; background-color: #D9D9D9">
            <div class="card-body">
                <table class="table table-sm table-borderless mb-2" style="background-color: white; border-radius: 10px;">
                    <thead>
                        <tr>
                            <td colspan="2" class="text-center">Daftar Anggota Kelompok Tani</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">Penerimaan Bagi Hasil TBS KKPA KUD Sawit Jaya</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">Periode : {{ $periodeBulan }} {{ $periodeTahun }}</td>
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
                            <td>: {{ count($anggotaTonase) }} KK</td>
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
                            <th>No Anggota</th>
                            <th>Luas Lahan</th>
                            <th>Pendapatan TBS Petani</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            function cleanLuasLahan($luas_lahan)
                            {
                                // Hapus karakter selain angka dan koma
                                $cleanedValue = preg_replace('/[^0-9,]/', '', $luas_lahan);

                                // Konversi koma menjadi titik sebagai pemisah desimal
                                $cleanedValue = str_replace(',', '.', $cleanedValue);

                                return $cleanedValue;
                            }

                            $totalTonase = 0;
                            $luasLahan = 0;
                            $no = 1;
                        @endphp
                        @foreach ($anggotaTonase as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->nama_anggota }}</td>
                                <td>{{ $item->no_anggota }}</td>
                                <td>{{ cleanLuasLahan($item->luas_lahan) }} Ha</td>
                                <td>{{ number_format($item->total_tonase) }} Kg</td>
                            </tr>
                            @php
                                $totalTonase += $item->total_tonase;
                                $luasLahan += cleanLuasLahan($item->luas_lahan);
                            @endphp
                        @endforeach
                        <tr>
                            <td colspan="3"><strong>Total Keseluruhan</strong></td>
                            <td style="font-weight: bold"><strong>{{ $luasLahan }} Ha</strong></td>
                            <td><strong>{{ number_format($totalTonase) }} Kg</strong></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
