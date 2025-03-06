<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThermometerToTestigo  extends Model
{
    use HasFactory;

    protected $fillable = [
        'thermometer_id',
        'testigo_id',
    ];
}
