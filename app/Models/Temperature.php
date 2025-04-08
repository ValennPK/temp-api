<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Temperature extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'thermometer_id',
        'sensor_id',
        'value',
    ];

    public function ultimasTemperaturas(int $termometro,int $sensor = 1) : void
    {
        $respuesta =  $this->where('thermometer_id',$termometro)
                    ->where('sensor_id', $sensor)
                    ->get();
        dd($respuesta);

    }
}
