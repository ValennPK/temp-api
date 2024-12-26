<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThermometersController extends Controller
{
    public function index() {
        return view('thermometers.index');
    }
}
