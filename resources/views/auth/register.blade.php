@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center min-vh-100 bg-body-tertiary">
        <div class="card shadow-sm border-0 rounded-4" style="max-width: 700px; width: 100%;">
            <div class="card-body p-4 p-md-4">

                <div class="text-center mb-4">
                    <h1 class="h2 fw-bold text-primary">Create an Account</h1>
                </div>

               

                <form action="{{ route('register') }}" method="POST" novalidate>
                    @csrf

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="name" class="form-label fw-semibold fs-6">Full Name</label>
                            <input type="text" class="form-control form-control-md @error('name') is-invalid @enderror"
                                id="name" name="name" placeholder="Enter Name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="username" class="form-label fw-semibold fs-6">Username</label>
                            <input type="text"
                                class="form-control form-control-md @error('username') is-invalid @enderror" id="username"
                                name="username" placeholder="Unique Username" value="{{ old('username') }}" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label fw-semibold fs-6">Email Address</label>
                            <input type="email" class="form-control form-control-md @error('email') is-invalid @enderror"
                                id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}"
                                required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label fw-semibold fs-6">Password</label>
                            <input type="password"
                                class="form-control form-control-md @error('password') is-invalid @enderror" id="password"
                                name="password" placeholder="Create a password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label fw-semibold fs-6">Confirm Password</label>
                            <input type="password" class="form-control form-control-md" id="password_confirmation"
                                name="password_confirmation" placeholder="Confirm your password" required>
                        </div>


                        <div class="col-md-6">
                            <label for="location" class="form-label fw-semibold fs-6">Location <span
                                    class="text-muted">(Optional)</span></label>
                            <input type="text"
                                class="form-control form-control-md @error('location') is-invalid @enderror" id="location"
                                name="location" placeholder="e.g., Pune, Maharashtra" value="{{ old('location') }}">
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-md fw-semibold btn-register">
                            Create Account
                        </button>
                    </div>

                    <p class="text-center text-muted mt-4 mb-0">
                        Already have an account?
                        <a href="{{ route('login') }}" class="fw-bold text-decoration-none">Log In</a>
                    </p>

                </form>
            </div>
        </div>
    </div>
@endsection
