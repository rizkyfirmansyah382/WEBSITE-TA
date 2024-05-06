<!DOCTYPE html>
<html lang="id">

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
        <span>SELISIH HASIL PANEN LAPANGAN DENGAN PABRIK KELAPA SAWIT</span><br>
        <span>PERIODE: {{ $tanggal_panen->format('d F Y') }}</span>
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
                    <td>: {{ count($tonasepanen) }} KK</td>
                </tr>
            </thead>
        </table>

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

    <p>Dibuat pada: {{ now()->format('d F Y') }}</p>
</body>

</html>
