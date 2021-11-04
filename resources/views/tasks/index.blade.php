@extends('layouts.app')

@section('title', 'Tasks')

@section('heading', 'Tasks')

@section('welcome')
    <div class="col">
        Hello, {{ auth()->user()->username }}!
    </div>
    <div class="col">
        <form method="post" action="/logout">
            @csrf
            <button type="submit" class="btn btn-primary">Log Out</button>
        </form>
    </div>
@endsection

@section('content')
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col" class="col-md-4"></th>
                <th scope="col" class="col-md-4">Description</th>
                <th scope="col" class="col-md-4">Completed At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>
                        <form method="post" action="/tasks/{{ $task->id }}/update-status">
                            @csrf
                            @method('patch')
                            <input type="checkbox"
                                   onchange="this.form.submit()" {{ $task->completed_at == null ?: 'checked' }}>
                        </form>
                    </td>
                    <td class="col-md-4">
                        <a
                            class="link-dark"
                            style="text-decoration: {{ $task->completed_at != null ? 'line-through' : 'none' }}"
                            href="/tasks/{{ $task->id }}"
                            onmouseover="this.style.textDecoration = 'underline'"
                            onmouseout="this.style.textDecoration = '{{ $task->completed_at != null ? 'line-through' : 'none' }}'"
                        >
                            {{ $task->description }}
                        </a>
                    </td>
                    <td>{{ $task->completed_at ?? 'Not Completed' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mb-3">
        <a href="/tasks/create" class="btn btn-primary" role="button">Create</a>
    </div>
@endsection
