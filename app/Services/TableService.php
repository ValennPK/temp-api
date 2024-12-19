<?php

namespace App\Services;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\SetpointHysteresis;
use Illuminate\Support\Facades\DB;

class TableService
{
    public static function thermometerTableCheck($tableName)
    {
        if (!Schema::hasTable($tableName)) {
            Schema::create($tableName, function (Blueprint $table) {
                $table->id();
                $table->decimal('port1', 6, 3)->nullable();
                $table->decimal('port2', 6, 3)->nullable();
                $table->decimal('port3', 6, 3)->nullable();
                $table->decimal('port4', 6, 3)->nullable();
                $table->decimal('port5', 6, 3)->nullable();
                $table->decimal('port6', 6, 3)->nullable();
                $table->decimal('port7', 6, 3)->nullable();
                $table->decimal('port8', 6, 3)->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    public static function setpointRegisterCheck($ThermometerName)
    {
        $setpoint = SetpointHysteresis::where('name', $ThermometerName)->first();

        if (!$setpoint) {
            DB::table('setpoint_hysteresis')->insert([
                'name' => $ThermometerName,
                'upper_s1' => 127,
                'lower_s1' => -127,
                'upper_s2' => 127,
                'lower_s2' => -127,
                'upper_s3' => 127,
                'lower_s3' => -127,
                'upper_s4' => 127,
                'lower_s4' => -127,
                'upper_s5' => 127,
                'lower_s5' => -127,
                'upper_s6' => 127,
                'lower_s6' => -127,
                'upper_s7' => 127,
                'lower_s7' => -127,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}