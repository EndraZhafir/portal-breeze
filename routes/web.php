<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/hello', function(){
    return "Halo, ini halaman percobaan route!";
});

Route::get('/admin', function(){
    return 'Admin Datanggg';
})->middleware(['auth', 'isAdmin'])->name('admin');

Route::get('/admin/jobs', function(){
    return 'Hi Admin - Kelola Lowongan Kerja';
})->middleware('auth', 'isAdmin')->name('adminJob');

Route::get('/jobs', function () {
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login');
    }

    if ($user->role === 'admin') {
        return redirect()->route('adminJob');
    }

    return app(JobController::class)->index();
})->name('job');

Route::middleware('auth', 'isUser')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
