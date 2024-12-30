<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Route::resource('user', UserController::class);
Route::resource('departments', DepartmentController::class);
Route::resource('staffs', StaffController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [StaffController::class, 'editMyProfile'])->name('staffs.editMyProfile');
    // Route::patch('/profile', [StaffController::class, 'update'])->name('staffs.updateMyProfile');
    // Route::delete('/profile', [StaffController::class, 'destroy'])->name('staffs.destroy');
});

require __DIR__.'/auth.php';
