<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\DataPanenKelompokModels;
use App\Models\KelompokAdminModels;
use App\Models\TanggalPanenKelompokModels;
use App\Models\UserSuperAdminModels;
use Illuminate\Http\Request;

class LaporanPanenUuoControllers extends Controller
{
    function index()
    {
        $uuo = UserSuperAdminModels::where('id_role', '=', '2')->get();
        return view('superadmin.laporanuuo.index', compact('uuo'));
    }

    public function pilihBulan($id_superadmin)
    {
        $bulanpanen = TanggalPanenKelompokModels::where('id_superadmin', $id_superadmin)
            ->selectRaw('DISTINCT DATE_FORMAT(tgl_panen, "%M %Y") as bulan_tahun')
            ->orderBy('tgl_panen', 'desc')
            ->paginate(10);

        $result = [];
        foreach ($bulanpanen as $bulan) {
            $id_tanggal_panen = TanggalPanenKelompokModels::where('id_superadmin', $id_superadmin)
                ->whereRaw('DATE_FORMAT(tgl_panen, "%M %Y") = ?', [$bulan['bulan_tahun']])
                ->pluck('id_tanggal_panen')
                ->toArray();
            $result[] = [
                'bulan_tahun' => $bulan['bulan_tahun'],
                'id_tanggal_panen' => $id_tanggal_panen,
            ];
        }

        // dd($result);
        return view('superadmin.laporanuuo.pilihbulan', compact('result', 'bulanpanen'));
    }

    public function checkLaporan($id_tanggal_panen)
    {
        // Pecah string menjadi array
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
                    if (!isset($kelompokData[$data->id_kelompok])) {
                        $kelompokData[$data->id_kelompok] = [
                            'nama_kelompok' => $kelompok->nama_kelompok,
                            'total_tonase' => $data->total_tonase,
                            'id_tanggal_panen' => $id_tanggal,
                        ];
                    } else {
                        // Jika sudah ada data untuk kelompok ini, tambahkan total tonase
                        $kelompokData[$data->id_kelompok]['total_tonase'] += $data->total_tonase;
                    }
                }
            }
        }

        // Ubah array asosiatif menjadi array biasa
        $kelompokData = array_values($kelompokData);

        // dd($kelompokData);

        return view('superadmin.laporanuuo.checklaporan', compact('kelompokData'));
    }
}
