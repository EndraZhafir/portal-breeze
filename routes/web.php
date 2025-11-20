<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::delete('/notifications/{id}/dismiss', [DashboardController::class, 'dismissNotification'])
    ->middleware(['auth'])
    ->name('notifications.dismiss');

Route::get('/hello', function(){
    return "Halo, percobaan route le!";
});

Route::get('/admin', function(){
    return 'Admin Page';
})->middleware(['auth', 'isAdmin'])->name('admin');

// route import & export 
Route::get('/jobs/import/template', [JobController::class, 'downloadTemplate'])->middleware(['auth', 'isAdmin'])->name('jobs.import.template');
Route::post('/jobs/import', [JobController::class, 'import'])->middleware(['auth', 'isAdmin'])->name('jobs.import');
Route::get('/applications/export', [ApplicationController::class, 'export'])->middleware(['auth', 'isAdmin'])->name('applications.export');

// halaman jobs
Route::resource('jobs', JobController::class)->middleware(['auth', 'isAdmin'])->except(['index', 'show']);
Route::resource('jobs', JobController::class)->middleware(['auth'])->only(['index', 'show']);

// siapa saja yang sudah melamar
Route::resource('applications', ApplicationController::class)->middleware(['auth', 'isAdmin'])->except(['index', 'show']);
Route::resource('applications', ApplicationController::class)->middleware(['auth'])->only(['index', 'show']);

// halaman aplikasi lamaran
Route::get('/jobs/{job}/applicants', [ApplicationController::class, 'index'])->middleware('isAdmin')->name('application.index');
Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->middleware('auth')->name('apply.store');


// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
