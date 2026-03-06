<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobController as AdminJobController;
use App\Http\Controllers\Admin\ApplicationController as AdminApplicationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ── Public ──────────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

// Jobs
Route::get('/jobs',                   [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{id}',              [JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs/{id}/apply',        [JobController::class, 'apply'])->name('jobs.apply');
Route::post('/jobs/{id}/apply',       [JobController::class, 'storeApplication'])->name('jobs.apply.store');

// ── Admin ────────────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/',                       [DashboardController::class, 'index'])->name('dashboard');

    // Jobs CRUD
    Route::get('/jobs',                   [AdminJobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/create',            [AdminJobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs',                  [AdminJobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{id}/edit',         [AdminJobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{id}',              [AdminJobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{id}',           [AdminJobController::class, 'destroy'])->name('jobs.destroy');

    // Applications (read-only)
    Route::get('/applications',           [AdminApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{id}',      [AdminApplicationController::class, 'show'])->name('applications.show');
});
