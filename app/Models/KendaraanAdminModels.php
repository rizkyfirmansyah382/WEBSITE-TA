<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KendaraanAdminModels extends Model
{
    use HasFactory;
    protected $table = ('tb_kendaraan');
    protected $primaryKey = 'id_kendaraan';

    protected $guarded = [];
}
