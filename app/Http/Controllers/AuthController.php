<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thermometer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Crear el usuario
        $thermometer = Thermometer::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User created successfully', $thermometer], 201);
    }


    public function login(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Buscar el usuario por email
        $thermometer = Thermometer::where('username', $request->username)->first();

        // Verificar el usuario y la contraseña
        if (!$thermometer || !Hash::check($request->password, $thermometer->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        if ($thermometer->has_permission != true) {
            return response()->json(['error' => 'You do not have permission'], 401);
        }

        // Crear un token para el usuario
        $token = $thermometer->createToken('Token Name', ['scope'], now()->addMinutes(240))->plainTextToken;


        // Devolver el token en la respuesta
        return response()->json(['token' => $token], 200);
    }
}
