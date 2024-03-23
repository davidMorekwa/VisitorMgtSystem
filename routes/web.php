<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\HandlerController;
use App\Http\Controllers\SaccoController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\VisitorController;
use App\Livewire\Dashboard;
use App\Livewire\Dashboard\Dashboard as DashboardDashboard;
use App\Livewire\Dashboard\SelectedVisitorForm;
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
Route::get('/test2', SelectedVisitorForm::class);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', DashboardDashboard::class)->name('dashboard');
    Route::get('/visits', [VisitController::class, 'getVisits']);
    Route::get('/dashboard/visitors', Visitors::class)->name('dashboard.visitors'); 
    Route::get('dashboard/visitors/{id}', [VisitorController::class, 'getVisitorVisits'])->name('dashboard.visitors.getVisits');
    // Route::get('dashboard/visitors/{purpose}', [VisitorController::class, 'getVisitorBySelectedPurpose'])->name('dashboard.visitors.getVistorsByPurpose');
    Route::get('/peakhours', [VisitorController::class, 'getPeakHours'])->name('peak_hours');
    Route::get('visitors/getbypurpose', [VisitorController::class, 'getVisitorByPurpose']);
});
