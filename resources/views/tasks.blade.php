@extends('layout')

@section('title', 'Tasks')

@section('heading', 'Tasks')

@section('content')
    <ul class="list-group">
        @foreach($tasks as $task)
            <li class="list-group-item w-50">{{ $task->description }}</li>
        @endforeach
    </ul>
@endsection
