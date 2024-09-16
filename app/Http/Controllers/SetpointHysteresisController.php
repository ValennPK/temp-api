<?php

namespace App\Http\Controllers;

use App\Models\SetpointHysteresis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SetpointHysteresisController extends Controller
{
    public function index($sensorName)
    {
        
        $setpoints = SetpointHysteresis::where('name', $sensorName)->get();

        return response()->json($setpoints, 200);
    }

    public function store(Request $request, $sensorName)
    {
    // Validar el sensorName
    $validator = Validator::make(
        ['sensorName' => $sensorName], 
        ['sensorName' => 'required|string|max:255']
    );

    // Verificar si la validación falla para sensorName
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Validar los demás datos en la solicitud
    $validatedData = $request->validate([
        'upper_s1' => 'required|numeric',
        'lower_s1' => 'required|numeric',
        'upper_s2' => 'required|numeric',
        'lower_s2' => 'required|numeric',
        'upper_s3' => 'required|numeric',
        'lower_s3' => 'required|numeric',
        'upper_s4' => 'required|numeric',
        'lower_s4' => 'required|numeric',
        'upper_s5' => 'required|numeric',
        'lower_s5' => 'required|numeric',
        'upper_s6' => 'required|numeric',
        'lower_s6' => 'required|numeric',
        'upper_s7' => 'required|numeric',
        'lower_s7' => 'required|numeric',
    ]);

    // Realizar validaciones adicionales sobre $validatedData
    $validator = Validator::make($validatedData, []);

    $validator->after(function ($validator) use ($validatedData) {
        for ($i = 1; $i <= 7; $i++) {
            $upper = $validatedData['upper_s' . $i];
            $lower = $validatedData['lower_s' . $i];

            // Verificar que la diferencia sea al menos de 4 grados
            if (($upper - $lower) < 4) {
                $validator->errors()->add('upper_s' . $i, 'La diferencia entre upper_s' . $i . ' y lower_s' . $i . ' debe ser al menos 4 grados.');
                return response()->json($validator->errors(), 422);
            }

            // Verificar que lower no sea mayor que upper
            if ($lower > $upper) {
                $validator->errors()->add('lower_s' . $i, 'El valor de lower no puede ser mayor que upper en el sensor ' . $i . '.');
                return response()->json($validator->errors(), 422);
            }
        }
    });


    // Verificar si la validación falla para los datos del setpoint
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // If the SetpointHysteresis already exists, update it. Otherwise, create a new one.
    $setpoint = SetpointHysteresis::where('name', $sensorName)->first();

    if ($setpoint) {
        $setpoint->update($validatedData);
    } else {
        $validatedData['name'] = $sensorName;
        $setpoint = SetpointHysteresis::create($validatedData);
    }

    return response()->json($setpoint, 201);
    }
    
}