<?php

namespace App\Http\Controllers;

use App\Models\SetpointHysteresis;
use Illuminate\Http\Request;

class SetpointHysteresisController extends Controller
{
    public function index($sensorName)
    {
        
        $setpoints = SetpointHysteresis::where('name', $sensorName)->get();

        return response()->json($setpoints, 200);
    }

    public function store(Request $request, $sensorName)
    {
        $validatedData = $request->validate([
            'upper_hyst' => 'required|integer',
            'lower_hyst' => 'required|integer',
        ]);

        // Upper hysteresis must be greater than lower hysteresis
        if ($validatedData['upper_hyst'] < $validatedData['lower_hyst']) {
            return response()->json(['error' => 'upper_hyst cannot be less than lower_hyst.'], 422);
        }

        // The difference between upper_hyst and lower_hyst must be at least 4.
        if (($validatedData['upper_hyst'] - $validatedData['lower_hyst']) < 4) {
            return response()->json(['error' => 'The difference between upper_hyst and lower_hyst must be at least 4.'], 422);
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