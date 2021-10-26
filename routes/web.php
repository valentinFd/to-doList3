<?php

use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', function ()
{
    return redirect('/tasks');
});
Route::get('/tasks', function ()
{
    return view('tasks', [
        'tasks' => Task::all()
    ]);
});
