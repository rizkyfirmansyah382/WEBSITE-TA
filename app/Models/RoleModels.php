<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModels extends Model
{
    use HasFactory;

    protected $table = 'tb_role';

    protected $primaryKey = 'id_role';

    protected $guarded = [];
}
