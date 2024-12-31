<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThermometerController extends Controller
{

    public function showTemperatures($thermometerName) {
        return view('thermometers.temperatures', compact('thermometerName'));
    }
}
