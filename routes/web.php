<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\web\ThermometerController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {return redirect('/login');});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/thermometer/{thermometerName}', [ThermometerController::class, 'showTemperatures']);
