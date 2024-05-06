<?php

namespace App\Http\Controllers\Admin;

use App\Exports\LaporanPanenAnggotaKelompokExcel;
use PDF;
// use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use App\Models\KelompokAdminModels;
use App\Models\TanggalPanenKelompokModels;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;


class LaporanPanenAnggotaKelompok extends Controller
{
    function index()
    {
        $AdminId = Auth::user()->id;
        $kelompok = KelompokAdminModels::where('id_superadmin', $AdminId)->get();
        // dd($kelompok);
        return view('admin.laporan.panenanggotakelompok.index', compact('kelompok'));
    }

    public function pilihbulan($id_kelompok)
    {
        $bulanpanen = TanggalPanenKelompokModels::where('id_kelompok', $id_kelompok)
            ->selectRaw('DISTINCT DATE_FORMAT(tgl_panen, "%M %Y") as bulan_tahun')
            ->orderBy('tgl_panen', 'desc') // Menambahkan pengurutan descending
            ->paginate(10);

        $result = [];
        foreach ($bulanpanen as $bulan) {
            $id_tanggal_panen = TanggalPanenKelompokModels::where('id_kelompok', $id_kelompok)
                ->whereRaw('DATE_FORMAT(tgl_panen, "%M %Y") = ?', [$bulan['bulan_tahun']])
                ->pluck('id_tanggal_panen')
                ->toArray();
            $result[] = [
                'bulan_tahun' => $bulan['bulan_tahun'],
                'id_tanggal_panen' => $id_tanggal_panen,
            ];
        }

        return view('admin.laporan.panenanggotakelompok.pilihbulan', compact('result', 'bulanpanen'));
    }

    public function checklaporan($id_tanggal_panen)
    {
        $id_tanggal_panen_array = explode(',', $id_tanggal_panen);

        // Ambil data tonase panen dan nama anggota berdasarkan ID tanggal panen
        $laporan = TanggalPanenKelompokModels::whereIn('id_tanggal_panen', $id_tanggal_panen_array)->get();

        // Ambil data anggota berdasarkan ID kelompok
        $id_kelompok = $laporan->first()->id_kelompok;

        $kelompok = KelompokAdminModels::find($id_kelompok);

        // Extract month and year from the first bulan_tahun
        $firstBulanTahun = $laporan->first()->tgl_panen;
        $periodeBulan = date('F', strtotime($firstBulanTahun)); // F gives full month name
        $periodeTahun = date('Y', strtotime($firstBulanTahun));

        $anggotaTonase = TanggalPanenKelompokModels::where('tb_tanggal_panen.id_kelompok', $id_kelompok)
            ->whereIn('tb_tanggal_panen.id_tanggal_panen', $id_tanggal_panen_array)
            ->join('tb_data_panen_kelompok', 'tb_tanggal_panen.id_tanggal_panen', '=', 'tb_data_panen_kelompok.id_tanggal_panen')
            ->join('tb_anggota_tervalidasi', 'tb_data_panen_kelompok.id_anggota_tervalidasi', '=', 'tb_anggota_tervalidasi.id_anggota_tervalidasi')
            ->select('tb_anggota_tervalidasi.nama_anggota', 'tb_anggota_tervalidasi.no_anggota', 'tb_anggota_tervalidasi.luas_lahan', DB::raw('SUM(tb_data_panen_kelompok.tonase_anggota) as total_tonase'))
            ->groupBy('tb_anggota_tervalidasi.id_anggota_tervalidasi', 'tb_anggota_tervalidasi.nama_anggota', 'tb_anggota_tervalidasi.no_anggota', 'tb_anggota_tervalidasi.luas_lahan')
            ->get();
        return view('admin.laporan.panenanggotakelompok.checklaporan', [
            'laporan' => $laporan,
            'anggotaTonase' => $anggotaTonase,
            'id_kelompok' => $id_kelompok,
            'nama_kelompok' => $kelompok->nama_kelompok,
            'periodeBulan' => $periodeBulan,
            'periodeTahun' => $periodeTahun,
        ]);
    }
    public function downloadLaporan($id_kelompok, $periodeBulan, $periodeTahun)
    {
        $laporan = TanggalPanenKelompokModels::where('id_kelompok', $id_kelompok)
            ->whereMonth('tgl_panen', date('m', strtotime($periodeBulan)))
            ->whereYear('tgl_panen', $periodeTahun)
            ->get();

        // Fetch Kelompok information
        $kelompok = KelompokAdminModels::find($id_kelompok);

        $anggotaTonase = TanggalPanenKelompokModels::where('tb_tanggal_panen.id_kelompok', $id_kelompok)
            ->whereMonth('tb_tanggal_panen.tgl_panen', date('m', strtotime($periodeBulan)))
            ->whereYear('tb_tanggal_panen.tgl_panen', $periodeTahun)
            ->join('tb_data_panen_kelompok', 'tb_tanggal_panen.id_tanggal_panen', '=', 'tb_data_panen_kelompok.id_tanggal_panen')
            ->join('tb_anggota_tervalidasi', 'tb_data_panen_kelompok.id_anggota_tervalidasi', '=', 'tb_anggota_tervalidasi.id_anggota_tervalidasi')
            ->select('tb_anggota_tervalidasi.nama_anggota', 'tb_anggota_tervalidasi.no_anggota', 'tb_anggota_tervalidasi.luas_lahan', DB::raw('SUM(tb_data_panen_kelompok.tonase_anggota) as total_tonase'))
            ->groupBy('tb_anggota_tervalidasi.id_anggota_tervalidasi', 'tb_anggota_tervalidasi.nama_anggota', 'tb_anggota_tervalidasi.no_anggota', 'tb_anggota_tervalidasi.luas_lahan')
            ->get();

        // Generate PDF content using the PDF class or your preferred PDF library
        $pdf = PDF::loadView('admin.laporan.panenanggotakelompok.pdf', [
            'laporan' => $laporan,
            'anggotaTonase' => $anggotaTonase,
            'nama_kelompok' => $kelompok->nama_kelompok, // Pass $kelompok to the view
            'periodeBulan' => $periodeBulan,
            'periodeTahun' => $periodeTahun,
        ]);

        // Set the file name for the downloaded PDF
        $fileName = 'Laporan Panen Kelompok ' . $kelompok->nama_kelompok . ' ' . $periodeBulan . ' ' . $periodeTahun . '.pdf';

        // Return the PDF as a download response
        return Response::make($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }

    public function downloadExcel($id_kelompok, $periodeBulan, $periodeTahun)
    {
        $kelompok = KelompokAdminModels::find($id_kelompok);

        $anggotaTonase = TanggalPanenKelompokModels::where('tb_tanggal_panen.id_kelompok', $id_kelompok)
            ->whereMonth('tb_tanggal_panen.tgl_panen', date('m', strtotime($periodeBulan)))
            ->whereYear('tb_tanggal_panen.tgl_panen', $periodeTahun)
            ->join('tb_data_panen_kelompok', 'tb_tanggal_panen.id_tanggal_panen', '=', 'tb_data_panen_kelompok.id_tanggal_panen')
            ->join('tb_anggota_tervalidasi', 'tb_data_panen_kelompok.id_anggota_tervalidasi', '=', 'tb_anggota_tervalidasi.id_anggota_tervalidasi')
            ->select('tb_anggota_tervalidasi.nama_anggota', 'tb_anggota_tervalidasi.no_anggota', 'tb_anggota_tervalidasi.luas_lahan', DB::raw('SUM(tb_data_panen_kelompok.tonase_anggota) as total_tonase'))
            ->groupBy('tb_anggota_tervalidasi.id_anggota_tervalidasi', 'tb_anggota_tervalidasi.nama_anggota', 'tb_anggota_tervalidasi.no_anggota', 'tb_anggota_tervalidasi.luas_lahan')
            ->get();

        $totalLuasLahan = 0;
        $totalPendapatanTBS = 0;

        $exportData = [];

        foreach ($anggotaTonase as $anggota) {
            // Konversi nilai luas lahan ke float
            $luasLahanNumeric = floatval(str_replace(',', '.', $anggota->luas_lahan));

            $rowData = [
                'Nama Anggota' => $anggota->nama_anggota,
                'No Anggota' => $anggota->no_anggota,
                'Luas Lahan' => $luasLahanNumeric,
                'Pendapatan TBS Petani' => is_numeric($anggota->total_tonase) ? $anggota->total_tonase : 0,
            ];

            $exportData[] = $rowData;

            // Hitung total Luas Lahan dan total Pendapatan TBS Petani
            $totalLuasLahan += $luasLahanNumeric;
            $totalPendapatanTBS += is_numeric($anggota->total_tonase) ? $anggota->total_tonase : 0;
        }


        // Add a row for the total keseluruhan
        $exportData[] = [
            'Nama Anggota' => 'Total Keseluruhan',
            'No Anggota' => '',
            'Luas Lahan' => $totalLuasLahan,
            'Pendapatan TBS Petani' => $totalPendapatanTBS,
        ];

        // Buat instance dari class LaporanPanenAnggotaKelompokExcel dengan data yang akan di-export
        $export = new LaporanPanenAnggotaKelompokExcel($exportData, 'Panen Anggota Kelompok');

        // Download file Excel
        return Excel::download($export, 'Laporan Panen Kelompok ' . $kelompok->nama_kelompok . ' ' . $periodeBulan . ' ' . $periodeTahun . '.xlsx');
    }

}