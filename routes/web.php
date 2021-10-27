<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', [SessionsController::class, 'create'])->name('login')->middleware('guest');
Route::post('/', [SessionsController::class, 'store'])->middleware('guest');

Route::post('/logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/tasks', function ()
{
    return view('tasks.index', [
        'tasks' => Task::all()
    ]);
})->middleware('auth');
