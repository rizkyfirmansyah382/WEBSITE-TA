<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSpbMandorModels extends Model
{
    use HasFactory;

    protected $table = ('tb_data_spb');
    protected $primaryKey = ('id_data_spb');

    protected $guard = [];

    protected $fillable = [
        'id_superadmin',
        'id_tanggal_panen',
        'id_kelompok',
        'total_janjang',
        'id_sopir',
        'id_kendaraan',
        'id_blok',
        'no_spb',
        'tujuan_pks',
    ];
}
