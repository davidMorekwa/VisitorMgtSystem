<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\HandlerController;
use App\Http\Controllers\SaccoController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\VisitorController;
use App\Livewire\Dashboard\Visitors;
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

Route::get('/', [Controller::class, 'showHomeScreen'])->name('visitor.home');
// Route::get('/visitor/register', Form::class)->name('visitor.register');
Route::get('/visitor/register', [VisitorController::class, 'showRegistrationForm'])->name('visitor.register');
Route::get('/thankyou', [VisitorController::class, 'showThankYouPage']);
Route::get('/test', [SaccoController::class, 'getSaccoPortfolioID']);
Route::get('/test/handler', [HandlerController::class, 'getPortfolioHandler']);
Route::post('/test/visit/add', [VisitController::class, 'saveVisitInformation']);
Route::get('/visits', [VisitController::class, 'getVisits']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.dashboard');
    })->name('dashboard');
    Route::get('dashboard/visitors', Visitors::class)->name('dashboard.visitors'); 
    Route::get('dashboard/visitors/{id}', [VisitorController::class, 'getVisitorVisits'])->name('dashboard.visitors.getVisits');
    Route::delete('dashboard/visitors/delete', [VisitorController::class, 'deleteVisitor'])->name('dashboard.visitors.delete')->middleware('role');
});
