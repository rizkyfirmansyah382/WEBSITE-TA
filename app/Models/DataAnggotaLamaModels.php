<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAnggotaLamaModels extends Model
{
    use HasFactory;

    protected $table = ('tb_data_anggota_lama');
    protected $primaryKey = ('id_data_anggota_lama');
    protected $guard = [];
    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_keluar' => 'date',
    ];

    protected $fillable = [
        'id_blok',
        'id_superadmin',
        'id_kelompok',
        'id_anggota_lama',
        'photo',
        'nama_anggota_lama',
        'nik',
        'alamat',
        'pekerjaan',
        'tanggal_lahir',
        'jenis_kelamin',
        'no_anggota',
        'tanggal_keluar',
    ];
}
