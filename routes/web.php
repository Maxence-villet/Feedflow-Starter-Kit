<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SurveyController;
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
    Route::get('/organizations/detail/{organization}', [OrganizationController::class, 'detail'])->name('organizations.detail');
    Route::delete('/organizations/delete/{organization}', [OrganizationController::class, 'destroy'])->name('organizations.destroy');
    Route::put('/organizations/update/{organization}', [OrganizationController::class, 'update'])->name('organizations.update');
    Route::get('/organizations/edit/{organization}', [OrganizationController::class, 'edit'])->name('organizations.edit');
    Route::post('/organizations/{organization}/users', [OrganizationController::class, 'storeOrganizationUser'])->name('organizations.users.store');
    Route::delete('/organizations/{organization}/users/{user}', [OrganizationController::class, 'destroyOrganizationUser'])->name('organizations.users.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/survey', [SurveyController::class, 'index'])->name('survey.index');
    Route::get('/survey/create', [SurveyController::class, 'create'])->name('survey.create');
    Route::post('/survey', [SurveyController::class, 'store'])->name('survey.store');
    Route::get('/survey/detail/{survey}', [SurveyController::class, 'detail'])->name('survey.detail');
    Route::delete('/survey/delete/{survey}', [SurveyController::class, 'destroy'])->name('survey.destroy');
    Route::put('/survey/update/{survey}', [SurveyController::class, 'update'])->name('survey.update');
    Route::get('/survey/edit/{survey}', [SurveyController::class, 'edit'])->name('survey.edit');
    Route::post('/survey/notify/{survey}', [SurveyController::class, 'swapNotification'])->name('survey.answers.swap');
    Route::get('/survey/{survey}/questions', [SurveyController::class, 'show'])->name('survey.questions.index');
    Route::get('/survey/{survey}/questions/create', [SurveyController::class, 'createQuestion'])->name('survey.questions.create');
    Route::post('/survey/{survey}/questions', [SurveyController::class, 'storeQuestion'])->name('survey.questions.store');
    Route::get('/survey/questions/{surveyQuestion}/edit', [SurveyController::class, 'editQuestion'])->name('survey.questions.edit');
    Route::put('/survey/questions/{surveyQuestion}', [SurveyController::class, 'updateQuestion'])->name('survey.questions.update');
    Route::delete('/survey/questions/{surveyQuestion}', [SurveyController::class, 'destroyQuestion'])->name('survey.questions.destroy');
});

Route::post('/survey/answers', [SurveyController::class, 'storeAnswer'])->name('survey.answers.store');
Route::get('/public/survey/{id}', [SurveyController::class, 'showPublicById'])->name('survey.public.id');
Route::get('/surve/thankyou', [SurveyController::class, 'thankyou'])->name('survey.thankyou');
require __DIR__.'/auth.php';
