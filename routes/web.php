<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrganizationController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
    Route::get('/organizations/create', [OrganizationController::class, 'create'])->name('organizations.create');
    Route::post('/organizations', [OrganizationController::class, 'store'])->name('organizations.store');
    Route::get('/organizations', [OrganizationController::class, 'index'])->name('organizations.index');
    Route::delete('/organizations/delete/{organization}', [OrganizationController::class, 'destroy'])->name('organizations.destroy');
    Route::put('/organizations/update/{organization}', [OrganizationController::class, 'update'])->name('organizations.update');
    Route::get('/organizations/edit/{organization}', [OrganizationController::class, 'edit'])->name('organizations.edit');
});

require __DIR__.'/auth.php';
