<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SetpointHysteresis extends Model
{
    use HasFactory, SoftDeletes;

    // Define la tabla asociada al modelo
    protected $table = 'setpoint_hysteresis';

    // Define los campos que pueden ser asignados masivamente
    protected $fillable = [
        'name',
        'upper_hyst',
        'lower_hyst',
    ];
}
