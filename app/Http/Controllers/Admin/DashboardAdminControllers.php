<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TanggalPanenKelompokModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Auth;

class DashboardAdminControllers extends Controller
{
    public function index()
    {
        $chartData = $this->getMonthlyChartData();
        // dd($chartData)->toArray();
        return view('admin.dashboard.index', compact('chartData'));
    }
    private function getMonthlyChartData()
    {
        $userId = Auth::id();

        $harvestData = TanggalPanenKelompokModels::join('tb_data_panen_kelompok', 'tb_tanggal_panen.id_tanggal_panen', '=', 'tb_data_panen_kelompok.id_tanggal_panen')
            ->join('tb_kelompok', 'tb_kelompok.id_kelompok', '=', 'tb_data_panen_kelompok.id_kelompok')
            ->where('tb_kelompok.id_superadmin', $userId) // Filter by the logged-in user's ID
            ->selectRaw('SUM(tb_data_panen_kelompok.tonase_anggota) as total_tonase, tb_kelompok.id_kelompok, tb_kelompok.nama_kelompok, DATE_FORMAT(tb_tanggal_panen.tgl_panen, "%M %Y") as bulan_tahun')
            ->groupBy('tb_kelompok.id_kelompok', 'tb_kelompok.nama_kelompok', DB::raw('DATE_FORMAT(tb_tanggal_panen.tgl_panen, "%M %Y")'))
            ->orderBy('tb_kelompok.id_kelompok')
            ->orderBy('tb_tanggal_panen.tgl_panen')
            ->get();

        $datasets = [];

        foreach ($harvestData as $harvest) {
            $kelompokName = $harvest->nama_kelompok;
            $bulanTahun = $harvest->bulan_tahun;
            $tonase = $harvest->total_tonase;

            // Create dataset for each kelompok if not already present
            if (!isset($datasets[$kelompokName])) {
                $datasets[$kelompokName] = [
                    'label' => $kelompokName,
                    'data' => [],
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1,
                ];
            }

            // Populate dataset with total tonase for each month
            $datasets[$kelompokName]['data'][] = $tonase;
        }

        // Extract unique bulan_tahun values as labels
        $labels = $harvestData->pluck('bulan_tahun')->unique()->values()->toArray();

        $finalData = [
            'labels' => $labels,
            'datasets' => array_values($datasets),
        ];

        return $finalData;
    }





}
