<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\EvaluationEleveController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/login', function() {
    return view('auth.login');
})->withoutMiddleware('auth')->name('login');

Route::resource('modules', ModuleController::class);

Route::resource('eleves', EleveController::class);
Route::get('/eleves/{eleveId}/notes', [EleveController::class, 'showNotes'])->name('eleves.notes');

Route::resource('evaluations', EvaluationController::class);
Route::get('/evaluations/{evaluationId}/notes', [EvaluationEleveController::class, 'showNotes'])->name('evaluations_eleves.notes');
Route::get('/evaluations/{evaluationId}/nuls', [EvaluationEleveController::class, 'showNuls'])->name('evaluations_eleves.nuls');

Route::resource('evaluations_eleves', EvaluationEleveController::class);

require __DIR__.'/auth.php';
