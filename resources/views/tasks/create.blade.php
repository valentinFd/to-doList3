@extends('layouts.app')

@section('title', 'Create Task')

@section('heading', 'Create Task')

@section('content')
    <form method="post" action="/tasks">
        @csrf
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control w-50" id="description" name="description"
                   value="{{ old('description') }}" required>
        </div>
        @error('description')
        <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
    <div class="mb-3">
        <a href="/tasks" class="btn btn-primary" role="button">Back</a>
    </div>
@endsection
