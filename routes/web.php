<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Register;

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

Route::middleware('web')->group(function () {
    Route::view('/', 'welcome');
});

Route::get('/register', Register::class)->name('register');
