<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route yang harus login
Route::middleware('auth')->group(function () {

    // Tampilkan Data
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // Update data
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Delate khusus admin
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
