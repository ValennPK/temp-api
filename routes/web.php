<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\web\ThermometerController;
use App\Http\Controllers\HomeController;

Route::view('/', 'public.inicio')->name('inicio');
Route::view('/vision-mision', 'public.vision-mision')->name('vision-mision');
Route::view('/quienes-somos', 'public.quienes-somos')->name('quienes-somos');
Route::view('/servicios', 'public.servicios')->name('servicios');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/thermometer/{thermometerName}', [ThermometerController::class, 'showTemperatures']);



// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
 
//     return redirect('/home');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();
 
//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
