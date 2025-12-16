<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SurveyController;
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
    Route::get('/survey', [SurveyController::class, 'index'])->name('survey.index');
    Route::get('/survey/create', [SurveyController::class, 'create'])->name('survey.create');
    Route::post('/survey', [SurveyController::class, 'store'])->name('survey.store');
    Route::get('/survey/detail/{survey}', [SurveyController::class, 'detail'])->name('survey.detail');
    Route::delete('/survey/delete/{survey}', [SurveyController::class, 'destroy'])->name('survey.destroy');
    Route::put('/survey/update/{survey}', [SurveyController::class, 'update'])->name('survey.update');
    Route::get('/survey/edit/{survey}', [SurveyController::class, 'edit'])->name('survey.edit');
});

require __DIR__.'/auth.php';
