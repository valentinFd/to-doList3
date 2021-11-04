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
        $task = Task::make($attributes);
        $task->user()->associate(auth()->user());
        $task->save();
        return redirect('/tasks');
    }

    public function show(Task $task)
    {
        if ((auth()->id() != $task->user->id)) abort(404);
        return view('tasks.show', ['task' => $task]);
    }

    public function edit(Task $task)
    {
        if ((auth()->id() != $task->user->id)) abort(404);
        return view('tasks.edit', ['task' => $task]);
    }

    public function update(Request $request, Task $task)
    {
        if ((auth()->id() != $task->user->id)) abort(404);
        $attributes = $request->validate([
            'description' => ['required', 'min:3', 'max:255']
        ]);
        $task->update($attributes);
        return redirect('/tasks/' . $task->id);
    }

    public function destroy(Task $task)
    {
        if ((auth()->id() != $task->user->id)) abort(404);
        $task->delete();
        return redirect('/tasks');
    }

    public function updateStatus(Task $task)
    {
        if ((auth()->id() != $task->user->id)) abort(404);
        $task->completed_at = $task->completed_at == null ? now() : null;
        $task->save();
        return redirect('/tasks');
    }
}
