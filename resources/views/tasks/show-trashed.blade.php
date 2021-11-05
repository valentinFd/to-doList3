@extends('layouts.app')

@section('title', 'Show Trashed Task')

@section('heading', 'Show Trashed Task')

@section('content')
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col" class="col-md-2">Description</th>
                <th scope="col" class="col-md-2">Completed At</th>
                <th scope="col" class="col-md-2">Created At</th>
                <th scope="col" class="col-md-2">Updated At</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="col-md-2">{{ $task->description }}</td>
                <td class="col-md-2">{{ $task->completed_at ?? 'Not Completed' }}</td>
                <td class="col-md-2">{{ $task->created_at }}</td>
                <td class="col-md-2">{{ $task->updated_at }}</td>
            </tr>
        </tbody>
    </table>
    <div class="row">
        <form method="post" action="/tasks/trashed/{{ $task->id }}" class="mb-3">
            @csrf
            @method('patch')
            <div class="col-md-auto">
                <button type="submit" class="btn btn-primary" onclick="return confirm('Restore task?')">Restore</button>
            </div>
        </form>
        <form method="post" action="/tasks/trashed/{{ $task->id }}">
            @csrf
            @method('delete')
            <div class="mb-3">
                <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are you sure?\nTask\'s data will be unrecoverable.')">Delete
                </button>
            </div>
        </form>
        <div class="col-md-auto">
            <a href="/tasks/trashed" class="btn btn-primary" role="button">Back</a>
        </div>
    </div>
@endsection
