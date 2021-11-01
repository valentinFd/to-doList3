@extends('layouts.app')

@section('title', 'Edit Task')

@section('heading', 'Edit Task')

@section('content')
    <form method="post" action="/tasks/{{ $task->id }}">
        @csrf
        @method('patch')
        <div class="mb-3">
            <label for="name" class="form-label">Description</label>
            <input type="text" class="form-control w-50" id="description" name="description"
                   value="{{ old('description') == "" ? $task->description : old('description') }}">
        </div>
        @error('description')
        <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
    <form action="/tasks/{{ $task->id }}" method="post">
        @csrf
        @method('delete')
        <div class="mb-3">
            <button type="submit" class="btn btn-danger" onclick="return confirm('Delete task?')">Delete</button>
        </div>
    </form>
    <div class="mb-3">
        <a href="/tasks/{{ $task->id }}" class="btn btn-primary" role="button">Back</a>
    </div>
@endsection
