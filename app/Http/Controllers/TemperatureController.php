<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
                $table->decimal('port8', 6, 3);
                $table->timestamps();
                $table->softDeletes();
            });
        }

        DB::table($ThermometerName)->insert([
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
        
        return response()->json($validatedData, 201);
    }
}
