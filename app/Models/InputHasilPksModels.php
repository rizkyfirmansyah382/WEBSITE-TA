<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputHasilPksModels extends Model
{
    use HasFactory;

    protected $table = ('tb_input_hasil_pks');
    protected $primaryKey = ('id_input_hasil_pks');

    protected $guard = [];

    protected $fillable = [
        'id_superadmin',
        'id_data_spb',
        'bruto',
        'tarra',
        'netto_terima',
        'sortasi',
        'netto_bersih',
    ];
}
