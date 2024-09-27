<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\SetpointHysteresis;
use App\Models\Excursion;

class TemperatureController extends Controller
{
    public function store(Request $request, $ThermometerName)
    {

        $validatedData = $request->validate([
            'port1' => 'required|numeric',
            'port2' => 'required|numeric',
            'port3' => 'required|numeric',
            'port4' => 'required|numeric',
            'port5' => 'required|numeric',
            'port6' => 'required|numeric',
            'port7' => 'required|numeric',
            'port8' => 'required|numeric',
        ]);

        
        if (!Schema::hasTable($ThermometerName)) {
            Schema::create($ThermometerName, function (Blueprint $table) {
                $table->id();
                $table->decimal('port1', 6, 3);
                $table->decimal('port2', 6, 3);
                $table->decimal('port3', 6, 3);
                $table->decimal('port4', 6, 3);
                $table->decimal('port5', 6, 3);
                $table->decimal('port6', 6, 3);
                $table->decimal('port7', 6, 3);
                $table->timestamps();
                $table->softDeletes();
            });
        }

        DB::table( $ThermometerName)->insert([
            'port1' => $request->input('port1'),
            'port2' => $request->input('port2'),
            'port3' => $request->input('port3'),
            'port4' => $request->input('port4'),
            'port5' => $request->input('port5'),
            'port6' => $request->input('port6'),
            'port7' => $request->input('port7'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);


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

        // foreach ($validatedData as $port => $value) {
        //     if ($value > $setpoint->upper_limit || $value < $setpoint->lower_limit) {
        //         DB::table('excursions')->insert([
        //             'thermometer_name' => $ThermometerName,
        //             'port_name' => $port,
        //             'value' => $value,
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ]);
        //     }
        // }



        return response()->json($validatedData, 201);
    }


    public function index($ThermometerName, $days)
    {
        $temperatures = DB::table($ThermometerName)->where('created_at', '>=', now()->subDays($days))->get();
        
        return response()->json($temperatures, 200);
    }

    public function index_port($ThermometerName, $days, $PortName)
    {     
        $temperatures = DB::table($ThermometerName)->select($PortName)->where('created_at', '>=', now()->subDays($days))->get();

        return response()->json($temperatures, 200);
    }

    public function last($ThermometerName)
    {
        if (!Schema::hasTable($ThermometerName)) {
            return response()->json(['message' => 'La tabla no existe'], 404);
        }

        
        $last = DB::table($ThermometerName)->orderBy('created_at', 'desc')->latest('created_at')->first();

        return response()->json($last, 200);
    }

    public function last_port($ThermometerName, $PortName)
    {
        if (!Schema::hasTable($ThermometerName)) {
            return response()->json(['message' => 'La tabla no existe'], 404);
        }

        if (!Schema::hasColumn($ThermometerName, $PortName)) {
            return response()->json(['message' => 'La columna no existe'], 404);
        }
        
        $last = DB::table($ThermometerName)->orderBy('created_at', 'desc')->latest('created_at')->first();

        $response = [
            'id' => $last->id,
            $PortName => $last->{$PortName},
            'created_at' => $last->created_at,
            'updated_at' => $last->updated_at,
            'deleted_at' => $last->deleted_at,
        ];


        return response()->json($response, 200);
    }
}

