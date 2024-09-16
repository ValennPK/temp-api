<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemperatureController;
use App\Http\Controllers\SetpointHysteresisController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StatusController;


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



Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->post('/{sensorName}/temperatures', [TemperatureController::class, 'store']);

Route::middleware('auth:sanctum')->get('/{sensorName}/setpoints', [SetpointHysteresisController::class, 'index']);
Route::middleware('auth:sanctum')->post('/{sensorName}/setpoints', [SetpointHysteresisController::class, 'store']);
