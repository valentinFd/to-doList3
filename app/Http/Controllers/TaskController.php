<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks;
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'description' => ['required', 'min:3', 'max:255']
        ]);
        $attributes['user_id'] = auth()->user()->id;
        Task::create($attributes);
        return redirect('/tasks');
    }

    public function show(Task $task)
    {
        if ((auth()->user()->id != $task->user->id)) return abort(404);
        return view('tasks.show', ['task' => $task]);
    }

    public function edit(Task $task)
    {
        if ((auth()->user()->id != $task->user->id)) return abort(404);
        return view('tasks.edit', ['task' => $task]);
    }

    public function update(Request $request, Task $task)
    {
        if ((auth()->user()->id != $task->user->id)) return abort(404);
        $attributes = $request->validate([
            'description' => ['required', 'min:3', 'max:255']
        ]);
        $task->update($attributes);
        return redirect('/tasks/' . $task->id);
    }

    public function destroy(Task $task)
    {
        if ((auth()->user()->id != $task->user->id)) return abort(404);
        $task->delete();
        return redirect('/tasks');
    }

    public function updateStatus(Request $request, Task $task)
    {
        if ((auth()->user()->id != $task->user->id)) return abort(404);
        $task->completed = $task->completed == 0 ? 1 : 0;
        $task->save();
        return redirect('/tasks');
    }
}
