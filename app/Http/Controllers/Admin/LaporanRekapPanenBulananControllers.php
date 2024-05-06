<?php

namespace App\Http\Controllers\Admin;

use App\Exports\RekapPanenBulananExcel;
use App\Http\Controllers\Controller;
use App\Models\AnggotaTervalidasiAdminModels;
use App\Models\DataPanenKelompokModels;
use App\Models\KelompokAdminModels;
use App\Models\TanggalPanenKelompokModels;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use PDF;

class LaporanRekapPanenBulananControllers extends Controller
{
    function index()
    {
        $adminId = Auth::user()->id;
        $bulanpanen = TanggalPanenKelompokModels::where('id_superadmin', $adminId)
            ->selectRaw('DISTINCT DATE_FORMAT(tgl_panen, "%M %Y") as bulan_tahun')
            ->orderBy('tgl_panen', 'desc')
            ->paginate(10);

        $result = [];
        foreach ($bulanpanen as $bulan) {
            $id_tanggal_panen = TanggalPanenKelompokModels::where('id_superadmin', $adminId)
                ->whereRaw('DATE_FORMAT(tgl_panen, "%M %Y") = ?', [$bulan['bulan_tahun']])
                ->pluck('id_tanggal_panen')
                ->toArray();
            $result[] = [
                'bulan_tahun' => $bulan['bulan_tahun'],
                'id_tanggal_panen' => $id_tanggal_panen,
            ];
        }
        return view('admin.laporan.rekappanenbulanan.index', compact('result', 'bulanpanen'));
    }

    function checkRekap($id_tanggal_panen)
    {
        $id_tanggal_panen_array = explode(',', $id_tanggal_panen);

        $kelompokData = [];

        foreach ($id_tanggal_panen_array as $id_tanggal) {
            $tonaseKelompok = DataPanenKelompokModels::select('id_kelompok', \DB::raw('SUM(tonase_anggota) as total_tonase'))
                ->where('id_tanggal_panen', $id_tanggal)
                ->groupBy('id_kelompok')
                ->get();

            foreach ($tonaseKelompok as $data) {
                $kelompok = KelompokAdminModels::where('id_kelompok', $data->id_kelompok)->first();
                if ($kelompok) {
                    // Gunakan id_kelompok sebagai kunci dalam array
                    $key = $data->id_kelompok;
                    if (!isset($kelompokData[$key])) {
                        $kelompokData[$key] = [
                            'nama_kelompok' => $kelompok->nama_kelompok,
                            'dates' => [],
                        ];
                    }

                    // Tambahkan data tanggal_panen ke dalam array dates
                    $kelompokData[$key]['dates'][] = [
                        'id_tanggal_panen' => $id_tanggal,
                        'total_tonase' => $data->total_tonase,
                    ];
                }
            }
        }

        // Ubah array asosiatif menjadi array biasa
        $kelompokData = array_values($kelompokData);

        // dd($id_tanggal_panen);

        return view('admin.laporan.rekappanenbulanan.checklaporan', compact('kelompokData', 'id_tanggal_panen'));
    }


    function checkData($id_tanggal_panen, $id_tanggal_panen_revisi)
    {
        $id_tanggal_panen_array = explode(',', $id_tanggal_panen_revisi);
        $kelompokData = [];

        foreach ($id_tanggal_panen_array as $id_tanggal) {
            $tonaseKelompok = DataPanenKelompokModels::select('id_kelompok', 'id_anggota_tervalidasi', 'id_data_panen_kelompok', \DB::raw('SUM(tonase_anggota) as total_tonase'))
                ->where('id_tanggal_panen', $id_tanggal)
                ->groupBy('id_kelompok', 'id_anggota_tervalidasi', 'id_data_panen_kelompok')
                ->get();

            foreach ($tonaseKelompok as $data) {
                $kelompok = KelompokAdminModels::where('id_kelompok', $data->id_kelompok)->first();
                $anggota = AnggotaTervalidasiAdminModels::find($data->id_anggota_tervalidasi);

                if ($kelompok && $anggota) {
                    $key = $data->id_kelompok . '_' . $data->id_anggota_tervalidasi;
                    if (!isset($kelompokData[$key])) {
                        $kelompokData[$key] = [
                            'nama_kelompok' => $kelompok->nama_kelompok,
                            'nama_anggota' => $anggota->nama_anggota,
                            'anggota_tervalidasi' => $data->id_anggota_tervalidasi,
                            'dates' => [],
                        ];
                    }

                    $kelompokData[$key]['dates'][] = [
                        'id_data_panen_kelompok' => $data->id_data_panen_kelompok,
                        'id_tanggal_panen' => $id_tanggal,
                        'total_tonase' => $data->total_tonase,
                    ];
                }
            }
        }

        // dd($kelompokData);
        return view('admin.laporan.rekappanenbulanan.checkdata', compact('kelompokData', 'id_tanggal_panen', 'id_tanggal_panen_revisi'));
    }

    public function downloadPDF($id_tanggal_panen, $id_tanggal_panen_revisi)
    {
        // Panggil fungsi checkData untuk mendapatkan data yang akan di-generate ke PDF
        $data = $this->checkData($id_tanggal_panen, $id_tanggal_panen_revisi);

        // Dapatkan kelompokData dari data
        $kelompokData = $data['kelompokData'];

        // dd($kelompokData);

        // Ambil bulan dan tahun dari tanggal_panen
        $bulan_tahun = TanggalPanenKelompokModels::find($id_tanggal_panen)->tgl_panen->format('F Y');

        // Selanjutnya, Anda dapat melanjutkan dengan menghasilkan PDF seperti biasa
        $pdf = PDF::loadView('admin.laporan.rekappanenbulanan.pdf', compact('data', 'kelompokData', 'bulan_tahun'));

        // Ubah nama file PDF sesuai kebutuhan dengan menambahkan bulan dan tahun
        $filename = 'Laporan Rekap Panen Bulanan ' . $bulan_tahun . '.pdf';

        return $pdf->download($filename);
    }

    public function downloadExcel($id_tanggal_panen, $id_tanggal_panen_revisi)
    {
        // Panggil method checkData untuk mendapatkan data yang akan di-export
        $data = $this->checkData($id_tanggal_panen, $id_tanggal_panen_revisi);

        // Buat array yang akan digunakan untuk membuat file Excel
        $exportData = [];

        foreach ($data['kelompokData'] as $kelompok) {
            $totalTonaseRotasi = 0;

            for ($i = 1; $i <= 4; $i++) {
                $key = $i - 1;
                $totalTonaseRotasi += isset($kelompok['dates'][$key]['total_tonase']) ? $kelompok['dates'][$key]['total_tonase'] : 0;
            }

            $rowData = [
                'Nama Anggota' => $kelompok['nama_anggota'],
                'Rotasi 1' => isset($kelompok['dates'][0]) ? $kelompok['dates'][0]['total_tonase'] . ' Kg' : '0 Kg',
                'Rotasi 2' => isset($kelompok['dates'][1]) ? $kelompok['dates'][1]['total_tonase'] . ' Kg' : '0 Kg',
                'Rotasi 3' => isset($kelompok['dates'][2]) ? $kelompok['dates'][2]['total_tonase'] . ' Kg' : '0 Kg',
                'Rotasi 4' => isset($kelompok['dates'][3]) ? $kelompok['dates'][3]['total_tonase'] . ' Kg' : '0 Kg',
                'Total Keseluruhan Tonase' => $totalTonaseRotasi . ' Kg',
            ];

            $exportData[] = $rowData;
        }

        $bulan_tahun = TanggalPanenKelompokModels::find($id_tanggal_panen)->tgl_panen->format('F_Y');

        $export = new RekapPanenBulananExcel($exportData, $bulan_tahun);

        return Excel::download($export, 'Rekap_Panen_Bulanan_' . $bulan_tahun . '.xlsx');
    }




}