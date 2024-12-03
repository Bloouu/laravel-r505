<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\EvaluationEleveController;

Route::get('/', function () {
    return view('welcome');
});

// Routes pour les modules
Route::resource('modules', ModuleController::class);

// Routes pour les évaluations
Route::resource('evaluations', EvaluationController::class);

// Routes pour les évaluations des élèves
Route::resource('evaluations_eleves', EvaluationEleveController::class);
/*
Route::get('notes/{evaluationId}/notes', [EvaluationEleveController::class, 'showNotes'])
    ->name('evaluations_eleves.notes');

Route::get('notes/{evaluationId}/nuls', [EvaluationEleveController::class, 'showNuls'])
    ->name('evaluations_eleves.nuls');*/

// Routes pour les élèves
Route::resource('eleves', EleveController::class);

Route::get('eleves/{eleveId}/notes', [EleveController::class, 'showNotes'])
    ->name('eleves.notes');