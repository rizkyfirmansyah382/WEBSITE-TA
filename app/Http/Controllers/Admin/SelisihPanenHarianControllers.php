<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SelisihPanenHarianExcel;
use App\Http\Controllers\Controller;
use App\Models\DataPanenKelompokModels;
use App\Models\DataSpbMandorModels;
use App\Models\KelompokAdminModels;
use App\Models\TanggalPanenKelompokModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Auth;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

class SelisihPanenHarianControllers extends Controller
{
    function index()
    {
        $AdminId = Auth::user()->id;
        $kelompok = KelompokAdminModels::where('id_superadmin', $AdminId)->get();
        // dd($kelompok);
        return view('admin.laporan.selisihpanenharian.index', compact('kelompok'));
    }

    function pilihTanggal($id_kelompok)
    {
        $tanggalpanen = TanggalPanenKelompokModels::where('id_kelompok', $id_kelompok)
            ->orderBy('tgl_panen', 'desc')
            ->get();
        return view('admin.laporan.selisihpanenharian.pilihtanggal', compact('tanggalpanen'));
    }

    function checkselisih($id_tanggal_panen, $id_kelompok)
    {
        $tanggal_panen = TanggalPanenKelompokModels::find($id_tanggal_panen);
        $kelompok = KelompokAdminModels::find($id_kelompok);
        $nettobersih = DataSpbMandorModels::select('tb_data_spb.*', 'tb_input_hasil_pks.netto_bersih')
            ->join('tb_input_hasil_pks', 'tb_data_spb.id_data_spb', '=', 'tb_input_hasil_pks.id_data_spb')
            ->where('id_tanggal_panen', $id_tanggal_panen)
            ->get();
        $tonasepanen = DataPanenKelompokModels::select('tb_data_panen_kelompok.*', 'tb_anggota_tervalidasi.nama_anggota')
            ->join('tb_anggota_tervalidasi', 'tb_data_panen_kelompok.id_anggota_tervalidasi', '=', 'tb_anggota_tervalidasi.id_anggota_tervalidasi')
            ->where('id_tanggal_panen', $id_tanggal_panen)
            ->get();
        // dd($tonasepanen->toArray());
        return view('admin.laporan.selisihpanenharian.checkselisih', [
            'tonasepanen' => $tonasepanen,
            'nettobersih' => $nettobersih,
            'id_kelompok' => $id_kelompok,
            'id_tanggal_panen' => $id_tanggal_panen,
            'tanggal_panen' => $tanggal_panen->tgl_panen,
            'nama_kelompok' => $kelompok->nama_kelompok,
        ]);
    }

    function downloadLaporan($id_tanggal_panen, $id_kelompok)
    {
        $tanggal_panen = TanggalPanenKelompokModels::find($id_tanggal_panen);
        $kelompok = KelompokAdminModels::find($id_kelompok);
        $nettobersih = DataSpbMandorModels::select('tb_data_spb.*', 'tb_input_hasil_pks.netto_bersih')
            ->join('tb_input_hasil_pks', 'tb_data_spb.id_data_spb', '=', 'tb_input_hasil_pks.id_data_spb')
            ->where('id_tanggal_panen', $id_tanggal_panen)
            ->get();
        $tonasepanen = DataPanenKelompokModels::select('tb_data_panen_kelompok.*', 'tb_anggota_tervalidasi.nama_anggota')
            ->join('tb_anggota_tervalidasi', 'tb_data_panen_kelompok.id_anggota_tervalidasi', '=', 'tb_anggota_tervalidasi.id_anggota_tervalidasi')
            ->where('id_tanggal_panen', $id_tanggal_panen)
            ->get();

        $pdf = PDF::loadView('admin.laporan.selisihpanenharian.pdf', [
            'tonasepanen' => $tonasepanen,
            'nettobersih' => $nettobersih,
            'id_kelompok' => $id_kelompok,
            'tanggal_panen' => $tanggal_panen->tgl_panen,
            'nama_kelompok' => $kelompok->nama_kelompok,
        ]);

        $fileName = 'Selisih Panen Harian Kelompok ' . $kelompok->nama_kelompok . ' Periode ' . $tanggal_panen->tgl_panen->format('d F Y') . '.pdf';

        return Response::make($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }

    public function downloadExcel($id_tanggal_panen, $id_kelompok)
    {
        $exportData = [];

        $tanggal_panen = TanggalPanenKelompokModels::find($id_tanggal_panen);
        $kelompok = KelompokAdminModels::find($id_kelompok);

        $nettobersih = DataSpbMandorModels::select('tb_data_spb.*', 'tb_input_hasil_pks.netto_bersih')
            ->join('tb_input_hasil_pks', 'tb_data_spb.id_data_spb', '=', 'tb_input_hasil_pks.id_data_spb')
            ->where('id_tanggal_panen', $id_tanggal_panen)
            ->get();

        $tonasepanen = DataPanenKelompokModels::select('tb_data_panen_kelompok.*', 'tb_anggota_tervalidasi.nama_anggota')
            ->join('tb_anggota_tervalidasi', 'tb_data_panen_kelompok.id_anggota_tervalidasi', '=', 'tb_anggota_tervalidasi.id_anggota_tervalidasi')
            ->where('id_tanggal_panen', $id_tanggal_panen)
            ->get();

        $totalTonaseAnggota = 0;
        $totalNettoBersih = 0;

        foreach ($tonasepanen as $anggota) {
            $rowData = [
                'Nama Anggota' => $anggota['nama_anggota'],
                'Tonase Anggota' => $anggota['tonase_anggota'],
            ];

            $exportData[] = $rowData;

            // Hitung total tonase anggota
            $totalTonaseAnggota += $anggota['tonase_anggota'];
        }

        // Hitung total netto bersih dari PKS
        foreach ($nettobersih as $netto) {
            $totalNettoBersih += $netto['netto_bersih'];
        }

        $exportData[] = ['Nama Anggota' => 'Total Keseluruhan PKS', 'Tonase Anggota' => $totalNettoBersih];

        // Tambahkan kolom untuk Selisih
        $selisih = $totalNettoBersih - $totalTonaseAnggota;
        $exportData[] = ['Nama Anggota' => 'Selisih', 'Tonase Anggota' => $selisih];

        // Ambil bulan dan tahun dari tanggal_panen
        $bulan_tahun = $tanggal_panen->tgl_panen->format('d F Y');
        $nama_kelompok = $kelompok->nama_kelompok;

        // Buat instance dari class SelisihPanenHarianExcel dengan data yang akan di-export
        $export = new SelisihPanenHarianExcel($exportData, $bulan_tahun);

        // Download file Excel
        return Excel::download($export, 'Selisih Panen Harian Kelompok ' . $nama_kelompok . ' ' . $bulan_tahun . '.xlsx');
    }

}