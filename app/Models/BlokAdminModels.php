<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlokAdminModels extends Model
{
    use HasFactory;

    protected $table = 'tb_blok';
    protected $primaryKey = 'id_blok';

    protected $guarded = [];
}
