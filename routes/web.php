<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', [SessionController::class, 'create'])->name('login')->middleware('guest');
Route::post('/', [SessionController::class, 'store'])->middleware('guest');

Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/tasks', function ()
{
    return view('tasks.index', [
        'tasks' => Task::all()
    ]);
})->middleware('auth');
