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

@if($tasks->count())
@section('content')
    <ul class="list-group">
        @foreach($tasks as $task)
            <li class="list-group-item w-50">{{ $task->description }}</li>
        @endforeach
    </ul>
@endsection
@endif
