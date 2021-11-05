@extends('layouts.app')

@section('title', 'Trashed Tasks')

@section('heading', 'Trashed Tasks')

@section('content')
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col" class="col-md-4">Description</th>
                <th scope="col" class="col-md-4">Completed At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td class="col-md-4">
                        <a
                            class="link-dark"
                            style="text-decoration: {{ $task->completed_at != null ? 'line-through' : 'none' }}"
                            href="/tasks/trashed/{{ $task->id }}"
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
    {{ $tasks->links() }}
    <div class="mb-3">
        <a href="/tasks" class="btn btn-primary" role="button">Back</a>
    </div>
@endsection
