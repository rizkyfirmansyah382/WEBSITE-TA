<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleAdminModels extends Model
{
    use HasFactory;
    protected $table = 'tb_role_admin';
    protected $primaryKey = 'id_role_admin';

    protected $guarded = [];
}
