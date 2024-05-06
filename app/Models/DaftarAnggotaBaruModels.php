<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarAnggotaBaruModels extends Model
{
    use HasFactory;
    protected $table = ('tb_daftar_anggota_baru');
    protected $primaryKey = ('id_daftar_anggota_baru');
    protected $guard = [];
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    protected $fillable = [
        'id_superadmin',
        'id_kelompok',
        'id_anggota_tervalidasi',
        'nama_anggota_baru',
        'nik',
        'alamat',
        'pekerjaan',
        'jenis_kelamin',
        'status',
        'KkPdf',
        'SertifPdf',
        'JBPdf',
        'tanggal_lahir',
        'photo',
    ];
}
