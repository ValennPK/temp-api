<?php

namespace App\Http\Controllers;

use App\Models\SetpointHysteresis;
use Illuminate\Http\Request;

class SetpointHysteresisController extends Controller
{
    public function index()
    {
        // Lógica para obtener los datos de la tabla
        return SetpointHysteresis::all();
    }
}