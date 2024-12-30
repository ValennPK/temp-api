<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use app\Livewire\ShowThermometer;

Route::get('/', function () {return redirect('/login');});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/thermometer/{thermometerName}', ShowThermometer::class);

