@extends('layouts.app')

@section('title', 'Show Task')

@section('heading', 'Show Task')

@section('content')
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col" class="col-md-2">Description</th>
                <th scope="col" class="col-md-2">Completed</th>
                <th scope="col" class="col-md-2">Created At</th>
                <th scope="col" class="col-md-2">Updated At</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="col-md-2">{{ $task->description }}</td>
                <td class="col-md-2">{{ $task->completed == 1 ? 'Yes' : 'No' }}</td>
                <td class="col-md-2">{{ $task->created_at }}</td>
                <td class="col-md-2">{{ $task->updated_at }}</td>
            </tr>
        </tbody>
    </table>
    <div class="row">
        <div class="col-md-auto">
            <a href="/tasks" class="btn btn-primary" role="button">Back</a>
        </div>
        <div class="col-md-auto">
            <a href="/tasks/{{ $task->id }}/edit" class="btn btn-primary" role="button">Edit</a>
        </div>
    </div>
@endsection
