<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Temperature;

class TemperatureController extends Controller
{
    public function store(Request $request)
    {
        // Validar la solicitud
        $validated = $request->validate([
            'port1' => 'required|integer',
            'port2' => 'required|integer',
            'port3' => 'required|integer',
            'port4' => 'required|integer',
            'port5' => 'required|integer',
            'port6' => 'required|integer',
            'port7' => 'required|integer',
            'port8' => 'required|integer',
        ]);

        // Crear un nuevo registro en la base de datos
        $temperature = Temperature::create($validated);

        return response()->json($temperature, 201);
    }
}
