<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemperatureController;
use App\Http\Controllers\SetpointHysteresisController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\StatController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/status', [StatusController::class, 'status']);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/data/{ThermometerName}/{days}', [TemperatureController::class, 'index']);

Route::get('/data/{ThermometerName}/{days}/sensor/{sensor_id}', [TemperatureController::class, 'index_sensor']);

Route::middleware('auth:sanctum')->post('/{ThermometerName}/temperatures', [TemperatureController::class, 'store']);

Route::middleware('auth:sanctum')->get('/{ThermometerName}/setpoints', [SetpointHysteresisController::class, 'index']);

Route::middleware('auth:sanctum')->post('/{ThermometerName}/setpoints', [SetpointHysteresisController::class, 'store']);

Route::get('/stat/{ThermometerName}/{days}', [StatController::class, 'index']);

