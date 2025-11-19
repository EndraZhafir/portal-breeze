<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/hello', function () {
    return "Halo, ini halaman percobaan route!";
});

Route::get('/admin', function () {
    return 'Admin Datanggg';
})->middleware(['auth', 'isAdmin'])->name('admin');

Route::resource('jobs', JobController::class)->middleware(['auth', 'isAdmin'])->except(['index', 'show']);

Route::resource('jobs', JobController::class)->middleware(['auth'])->only(['index', 'show']);

Route::post('/jobs/{jobId}/apply', [ApplicationController::class, 'store'])->name('apply.store')->middleware('auth');
Route::get('/jobs/{jobId}/applicants', [ApplicationController::class, 'index'])->name('applications.index')->middleware('isAdmin');

Route::resource('applications', ApplicationController::class)->middleware(['auth', 'isAdmin'])->except(['index', 'show']);
Route::resource('applications', ApplicationController::class)->middleware(['auth'])->only(['index', 'show']);

// Export and Import Routes
Route::get('/applications-export',[ApplicationController::class, 'export'])->name('applications.export')->middleware('isAdmin');
Route::post('/jobs/import', [JobController::class, 'import'])->name('jobs.import')->middleware('isAdmin');


// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
