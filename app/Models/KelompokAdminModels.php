<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokAdminModels extends Model
{
    use HasFactory;

    protected $table = 'tb_kelompok';
    protected $primaryKey = 'id_kelompok';

    protected $guarded = [];
}
