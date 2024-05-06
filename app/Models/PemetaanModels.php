<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemetaanModels extends Model
{
    use HasFactory;
    protected $table = ('tb_pemetaan');
    protected $primaryKey = 'id_pemetaan';

    protected $guarded = [];
}
