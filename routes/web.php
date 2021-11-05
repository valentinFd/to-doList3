<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SessionController::class, 'create'])->name('login')->middleware('guest');
Route::post('/', [SessionController::class, 'store'])->middleware('guest');

Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/tasks/trashed', [TaskController::class, 'indexTrashed'])->middleware('auth');

Route::get('/tasks/trashed/{id}', [TaskController::class, 'showTrashed'])->middleware('auth');
Route::patch('/tasks/trashed/{id}', [TaskController::class, 'restoreTrashed'])->middleware('auth');
Route::delete('/tasks/trashed/{id}', [TaskController::class, 'destroyTrashed'])->middleware('auth');

Route::resource('tasks', TaskController::class)->middleware('auth');

Route::patch('/tasks/{task}/update-status', [TaskController::class, 'updateStatus'])->middleware('auth');
