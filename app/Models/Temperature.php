<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Temperature extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'port1',
        'port2',
        'port3',
        'port4',
        'port5',
        'port6',
        'port7',
        'port8',
    ];
}
