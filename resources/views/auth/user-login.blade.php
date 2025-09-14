@extends('layouts.app')

@section('content')
    {{-- A soft background helps the centered card to pop visually --}}
    <div class="d-flex justify-content-center align-items-center min-vh-100 bg-body-tertiary">

        <div class="card shadow-sm border-0 rounded-4 w-100" style="max-width: 450px;">
            <div class="card-body p-4 p-md-5">

                <div class="text-center mb-4">
                    {{-- A friendly icon and welcoming message --}}
                    <i class="fas fa-user-circle fa-3x text-primary mb-3"></i>
                    <h1 class="h3 fw-bold">Welcome Back!</h1>
                    <p class="text-muted">Sign in to continue.</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0 small ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" novalidate>
                    @csrf

                    {{-- Input Group with Floating Labels for a modern look --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-envelope fa-fw"></i></span>
                        <div class="form-floating">
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" placeholder="name@example.com"
                                value="{{ old('email') }}" required>
                            <label for="email">Email address</label>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-lock fa-fw"></i></span>
                        <div class="form-floating">
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                required>
                            <label for="password">Password</label>
                        </div>
                    </div>



                    {{-- Prominent login button --}}
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg fw-semibold">
                            <i class="fas fa-sign-in-alt me-2"></i> Log In
                        </button>
                    </div>

                    {{-- Registration link, as requested --}}
                    <p class="text-center text-muted mt-4 mb-0">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="fw-bold text-decoration-none">Sign Up</a>
                    </p>

                </form>
            </div>
        </div>
    </div>
@endsection
