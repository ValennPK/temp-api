<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function status()
    {
        return response()->json(['message' => 'El servidor está funcionando correctamente'], 200);
    }
}
