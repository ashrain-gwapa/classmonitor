<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaboratoryController;
use App\Models\Laboratory;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Change the old closure route to use the Controller method
Route::get('/dashboard', [LaboratoryController::class, 'studentIndex'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
// Routes for Faculty (Protected by Lorraine's Middleware)
Route::middleware(['auth', 'is_faculty'])->group(function () {
    Route::get('/faculty/dashboard', [LaboratoryController::class, 'facultyIndex'])->name('faculty.dashboard');
    Route::patch('/lab/update/{id}', [LaboratoryController::class, 'updateStatus'])->name('lab.update');
});
require __DIR__.'/auth.php';
