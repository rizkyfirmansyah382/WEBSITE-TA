<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPanenKelompokModels extends Model
{
    use HasFactory;

    protected $table = ('tb_data_panen_kelompok');
    protected $primaryKey = ('id_data_panen_kelompok');
    protected $guard = [];

    protected $fillable = [
        'id_superadmin',
        'id_kelompok',
        'id_anggota_tervalidasi',
        'id_tanggal_panen',
        'tonase_anggota',
    ];
}
