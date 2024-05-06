<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Panen</title>
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
        <span>PENERIMAAN BAGI HASIL TBS KKPA KUD SAWIT JAYA</span><br>
        <span>PERIODE : {{ $periodeBulan }} {{ $periodeTahun }}</span>
    </div>

    <div class="table-container">
        <table>
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

        <table>
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
                    <td><strong>{{ number_format($luasLahan) }} Ha</strong></td>
                    <td><strong>{{ number_format($totalTonase) }} Kg</strong></td>
                </tr>
            </tbody>
        </table>
    </div>

    <p>Generated on: {{ now()->format('d F Y') }}</p>
</body>

</html>
