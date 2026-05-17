<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaboratoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Welcome Landing Page View
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| 🔢 Custom 6-Digit Code Manual Verification Route
|--------------------------------------------------------------------------
*/
Route::post('/verify-code', function (Request $request) {
    $request->validate(['code' => 'required|numeric']);

    // Check if the code entered matches what is stored in the session cache memory
    if ((int)$request->code === (int)session('email_verification_code')) {
        $user = $request->user();
        
        // Mark user email status authenticated inside database
        $user->markEmailAsVerified();
        
        // Clear session code variable state
        session()->forget('email_verification_code');

        return redirect('/dashboard');
    }

    return back()->with('error', 'The verification code you typed is incorrect. Please try again.');
})->middleware(['auth']);

/*
|--------------------------------------------------------------------------
| 🎓 Student Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [LaboratoryController::class, 'index'])->name('dashboard');
/*
|--------------------------------------------------------------------------
| 👨‍🏫 Faculty Dashboard & Management Panel Routes
|--------------------------------------------------------------------------
*/
// Wrapped under Lorraine's 'is_faculty' custom middleware role-protection gate
Route::middleware(['auth', 'verified', 'is_faculty'])->group(function () {
    
    // Core Faculty Index View Layout
    Route::get('/faculty/dashboard', [LaboratoryController::class, 'facultyIndex'])
        ->name('faculty.dashboard');
        
    // Lab Core Management Panel UI Panel Data View
    Route::get('/faculty/management-panel', function() {
        $laboratories = \App\Models\Laboratory::all();
        return view('faculty.panel', compact('laboratories'));
    })->name('faculty.panel');

    // Laboratory Actions Handlers mapped directly to your Resource Controller Methods
    Route::post('/faculty/laboratory', [LaboratoryController::class, 'store'])->name('lab.store');
    Route::patch('/lab/update/{id}', [LaboratoryController::class, 'updateStatus'])->name('lab.update');
    Route::delete('/faculty/laboratory/{id}', [LaboratoryController::class, 'destroy'])->name('lab.destroy');
});

/*
|--------------------------------------------------------------------------
| ⚙️ Profile Management Subsystem Routing Data
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| 🔄 Background AJAX Real-time Verification Sync Route Fallback
|--------------------------------------------------------------------------
*/
Route::get('/api/check-email-verification', function (Request $request) {
    return response()->json([
        'verified' => $request->user() && $request->user()->hasVerifiedEmail()
    ]);
})->middleware('auth');

// 1. Secure group under standard 'auth' string middleware
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // 2. Extra structural layer to ensure ONLY the hardcoded admin gets in
    Route::group([], function () {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action. Admin clearance required.');
        }

        // Admin Dashboard Panels
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Admin Account Password Management
        Route::get('/change-password', [AdminController::class, 'editPassword'])->name('password.edit');
        Route::put('/change-password', [AdminController::class, 'updatePassword'])->name('password.update');
        
        // Faculty Live Data Modifications
        Route::get('/laboratory/{id}/edit', [AdminController::class, 'editLab'])->name('lab.edit');
        Route::put('/laboratory/{id}', [AdminController::class, 'updateLab'])->name('lab.update');
        Route::delete('/laboratory/{id}', [AdminController::class, 'destroyLab'])->name('lab.destroy');
    });

});

// Initialize Breeze Default Core Architecture Logic Handles
require __DIR__.'/auth.php';