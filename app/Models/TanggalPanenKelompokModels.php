<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TanggalPanenKelompokModels extends Model
{
    use HasFactory;

    protected $table = ('tb_tanggal_panen');
    protected $primaryKey = ('id_tanggal_panen');
    protected $guard = [];

    protected $fillable = [
        'id_superadmin',
        'id_kelompok',
        'tgl_panen',
    ];
    protected $casts = [
        'tgl_panen' => 'date',
    ];
}
