<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ThermometersController;
use App\Models\Thermometer;

Route::get('/register', Register::class)->name('register');


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::middleware('web')->group(function () {
//     Route::view('/', 'livewire.index')->redirectTo('/login');
// });

Route::get('/', function () {
    return redirect('/login');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/thermometers')->name('thermometers', [ThermometersController::class, 'index']);
