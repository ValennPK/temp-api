<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Excursion extends Model
{
   use HasFactory, SoftDeletes;

   protected $fillable = [
      'thermometer_name',
      'sensor_name',
      'value',
   ];
}
