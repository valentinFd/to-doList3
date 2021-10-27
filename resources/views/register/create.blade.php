@extends('layouts.app')

@section('title', 'Register')

@section('heading', 'Register')

@section('content')
    <form method="post" action="/register">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control w-50" id="username" name="username" value="{{ old('username') }}"
                   required>
        </div>
        @error('username')
        <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control w-50" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        @error('email')
        <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control w-50" id="password" name="password" required>
        </div>
        @error('password')
        <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </form>
    <div class="mb-3">
        <a class="link-primary" href="/">Back</a>
    </div>
@endsection
