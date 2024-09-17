<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Temperature;

class TemperatureController extends Controller
{
    public function store(Request $request, $sensorName)
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
        
        $temperature = new Temperature();
        $temperature->setTableName($sensorName);

        $temperature->create($validatedData);

        return response()->json($validatedData, 201);
    }
}

