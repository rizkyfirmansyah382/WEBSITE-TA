<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SopirAdminModels extends Model
{
    use HasFactory;

    protected $table = ('tb_sopir');
    protected $primaryKey = ('id_sopir');
    protected $guarded = [];
}
