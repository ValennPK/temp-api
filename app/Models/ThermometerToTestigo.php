<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThermometerToTestigo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'thermometer_to_testigo';

    protected $fillable = [
        'thermometer_id',
        'testigo_id',
    ];


}
