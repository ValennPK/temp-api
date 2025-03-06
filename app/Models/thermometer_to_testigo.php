<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thermometer_to_testigo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'thermometer_id',
        'testigo_id',
        'created_at',
        'updated_at',
    ];
}
