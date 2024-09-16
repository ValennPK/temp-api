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
        'upper_s1',
        'lower_s1',
        'upper_s2',
        'lower_s2',
        'upper_s3',
        'lower_s3',
        'upper_s4',
        'lower_s4',
        'upper_s5',
        'lower_s5',
        'upper_s6',
        'lower_s6',
        'upper_s7',
        'lower_s7',
    ];
}
