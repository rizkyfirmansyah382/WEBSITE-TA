<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rekapitulas Panen Bulanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            border: 2px solid;
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
            padding: 10px;
        }

        .table-container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 10px;
        }

        th,
        td {
            border: 1px solid #000000;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="container">
        <span>DAFTAR ANGGOTA KELOMPOK TANI</span><br>
        <span>LAPORAN REKAPITULASI HASIL PANEN BULANAN</span><br>
        {{-- Tampilkan periode jika diperlukan --}}
        <span>PERIODE : {{ $bulan_tahun }}</span>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <td>Kelompok Tani</td>
                    {{-- Tampilkan nama kelompok jika diperlukan --}}
                    <td>: {{ reset($kelompokData)['nama_kelompok'] }}</td>
                </tr>
                <tr>
                    <td>UUO</td>
                    @auth
                        {{-- Tampilkan nama pengguna jika diperlukan --}}
                        <td>: {{ auth()->user()->name }}</td>
                    @endauth
                </tr>
                <tr>
                    <td>Jumlah Anggota</td>
                    {{-- Tampilkan jumlah anggota jika diperlukan --}}
                    <td>: {{ count($kelompokData) }} KK</td>
                </tr>
            </thead>
        </table>

        <table class="table table-sm table-borderless" style="background-color: white; border-radius: 10px">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Anggota</th>
                    <th>Rotasi 1</th>
                    <th>Rotasi 2</th>
                    <th>Rotasi 3</th>
                    <th>Rotasi 4</th>
                    <th>Total Keseluruhan Tonase</th>
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

    <p>Generated on: {{ now()->format('d F Y') }}</p>
</body>

</html>
