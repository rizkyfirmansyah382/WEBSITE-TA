<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaTervalidasiAdminModels extends Model
{
    use HasFactory;

    protected $table = ('tb_anggota_tervalidasi');
    protected $primaryKey = ('id_anggota_tervalidasi');
    protected $guard = [];
    protected $casts = [
        'tgl_lahir' => 'date',
        'tgl_masuk_anggota' => 'date',
    ];

    protected $fillable = [
        'id_superadmin',
        'id_kelompok',
        'id_blok',
        'nama_anggota',
        'luas_lahan',
        'nik',
        'tgl_lahir',
        'jenis_kelamin',
        'pekerjaan',
        'alamat_tinggal',
        'tgl_masuk_anggota',
        'no_anggota',
        'photo',
    ];

}
