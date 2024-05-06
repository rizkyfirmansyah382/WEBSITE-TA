<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnggotaTervalidasiAdminModels;
use App\Models\DataPanenKelompokModels;
use App\Models\KelompokAdminModels;
use App\Models\TanggalPanenKelompokModels;
use Illuminate\Http\Request;
use Auth;

class RekapPanenBulananControllers extends Controller
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
        return view('admin.rekappanenbulanan.index', compact('result', 'bulanpanen'));
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

        return view('admin.rekappanenbulanan.checklaporan', compact('kelompokData', 'id_tanggal_panen'));
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

        return view('admin.rekappanenbulanan.checkdata', compact('kelompokData', 'id_tanggal_panen', 'id_tanggal_panen_revisi'));
    }


    function update($id_data_panen_kelompok, $id_tanggal_panen, $id_tanggal_panen_revisi)
    {
        $tonase = DataPanenKelompokModels::find($id_data_panen_kelompok);
        return view('admin.rekappanenbulanan.update', compact('tonase', 'id_tanggal_panen', 'id_tanggal_panen_revisi'));
    }

    function updateData(Request $request, $id_data_panen_kelompok, $id_tanggal_panen, $id_tanggal_panen_revisi)
    {
        DataPanenKelompokModels::where('id_data_panen_kelompok', $id_data_panen_kelompok)
            ->update([
                'tonase_anggota' => $request->input('tonase_anggota'),
            ]);
        return redirect("/rekap-panen-bulanan/checkData/{$id_tanggal_panen}/{$id_tanggal_panen_revisi}")->with('success', 'Update data panen anggota berhasil diperbarui.');
    }
}