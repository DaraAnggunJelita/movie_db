@extends('layouts.main')
@section('title', 'Login')
@section('navLogin', 'active')

@section('content')
<div class="container mt-5" style="max-width: 480px;">
    <div class="card shadow rounded-4 border-0">
        <div class="card-header bg-success text-white rounded-top-4 text-center">
            <h3 class="mb-0 fw-bold">Sign In</h3>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('login.post') }}" method="POST" novalidate>
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email address</label>
                    <input
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        placeholder="your.email@example.com"
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input
                        type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        id="password"
                        name="password"
                        required
                        placeholder="Enter your password"
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Forgot Password --}}
                <div class="mb-3 text-end">
                    <a href="#" class="text-decoration-none small">Forgot Password?</a>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn btn-success w-100 fw-semibold py-2">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection
