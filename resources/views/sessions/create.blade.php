@extends('layouts.app')

@section('title', 'Log In')

@section('heading', 'Log In')

@section('content')
    <form method="post" action="/">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control w-50" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control w-50" id="password" name="password" required>
        </div>
        @error('password')
        <p class="text-danger">{{ $message }}</p>
        @enderror
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Log In</button>
        </div>
    </form>
    <div class="mb-3">
        <a class="link-primary" href="/register">Register</a>
    </div>
@endsection
