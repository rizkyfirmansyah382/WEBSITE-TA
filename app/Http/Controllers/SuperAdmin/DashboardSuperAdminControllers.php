<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\TanggalPanenKelompokModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardSuperAdminControllers extends Controller
{
    public function index()
    {
        $chartData = $this->getMonthlyChartData();
        // dd($chartData)->toArray();
        return view('superadmin.dashboard.index', compact('chartData'));
    }
    private function getMonthlyChartData()
    {
        $harvestData = TanggalPanenKelompokModels::join('tb_data_panen_kelompok', 'tb_tanggal_panen.id_tanggal_panen', '=', 'tb_data_panen_kelompok.id_tanggal_panen')
            ->join('tb_kelompok', 'tb_kelompok.id_kelompok', '=', 'tb_data_panen_kelompok.id_kelompok')
            ->join('tb_user_superadmin', 'tb_user_superadmin.id', '=', 'tb_kelompok.id_superadmin')
            ->selectRaw('SUM(tb_data_panen_kelompok.tonase_anggota) as total_tonase, tb_user_superadmin.name as superadmin_name, DATE_FORMAT(tb_tanggal_panen.tgl_panen, "%M %Y") as bulan_tahun')
            ->groupBy('superadmin_name', DB::raw('DATE_FORMAT(tb_tanggal_panen.tgl_panen, "%M %Y")'))
            ->orderBy('superadmin_name')
            ->orderBy('tb_tanggal_panen.tgl_panen')
            ->get();

        $datasets = [];

        foreach ($harvestData as $harvest) {
            $superadminName = $harvest->superadmin_name;
            $bulanTahun = $harvest->bulan_tahun;
            $tonase = $harvest->total_tonase;

            // Create dataset for each superadmin if not already present
            if (!isset($datasets[$superadminName])) {
                $datasets[$superadminName] = [
                    'label' => $superadminName,
                    'data' => [],
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1,
                ];
            }

            // Populate dataset with total tonase for each month
            $datasets[$superadminName]['data'][] = $tonase;
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
