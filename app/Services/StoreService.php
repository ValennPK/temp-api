<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StoreService
{
    public static function storeTemperature($ThermometerName, Request $request)
    {
        DB::table( $ThermometerName)->insert([
            'port1' => $request->input('port1'),
            'port2' => $request->input('port2'),
            'port3' => $request->input('port3'),
            'port4' => $request->input('port4'),
            'port5' => $request->input('port5'),
            'port6' => $request->input('port6'),
            'port7' => $request->input('port7'),
            'port8' => $request->input('port8'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public static function storeMassTemperature($ThermometerName, Request $request)
    {
        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'dato') && $value !== null) {
                DB::table($ThermometerName)->insert([
                    'port1' => $value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}