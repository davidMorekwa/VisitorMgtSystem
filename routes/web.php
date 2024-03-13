<?php

use App\Http\Controllers\SaccoController;
use App\Livewire\Form;
use App\Livewire\Homescreen;
use App\Livewire\OfficialInformation;
use App\Livewire\ThankYou;
use Illuminate\Support\Facades\Route;

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

Route::get('/', HomeScreen::class)->name('visitor.home');
Route::get('/visitor/register', Form::class)->name('visitor.register');
Route::get('/thankyou', ThankYou::class)->name('visitor.thankyou');
Route::get('/test', [SaccoController::class, 'get']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
