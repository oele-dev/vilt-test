<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportCustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', WelcomeController::class);
Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')
    ->prefix('customers')
    ->name('customers.')
    ->group(function () {
        Route::get('/', [CustomersController::class, 'index'])->name('index');
        Route::post('/', [CustomersController::class, 'store'])->name('store');
        Route::get('/create', [CustomersController::class, 'create'])->name('create');
        // Export
        Route::get('/export', ExportCustomerController::class)->name('export');

        Route::get('/edit/{customer}', [CustomersController::class, 'edit'])->name('edit');
        Route::patch('/{customer}', [CustomersController::class, 'update'])->name('update');
        Route::delete('/{customer}', [CustomersController::class, 'destroy'])->name('destroy');
    });

require __DIR__.'/auth.php';
