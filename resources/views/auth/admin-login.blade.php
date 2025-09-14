@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center min-vh-100 bg-body-tertiary">

        <div class="card shadow-sm border-0 rounded-4 w-100" style="max-width: 450px;">
            <div class="card-body p-4 p-md-5">

                <div class="text-center mb-4">
                    <i class="fas fa-user-shield fa-3x text-primary mb-3"></i>
                    <h1 class="h3 fw-bold">Secure Access</h1>
                    <p class="text-muted">Admin & Moderator Portal</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <h6 class="alert-heading fw-semibold">Login Failed</h6>
                        <ul class="mb-0 small ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login') }}" novalidate>
                    @csrf

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-envelope fa-fw"></i></span>
                        <div class="form-floating">
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" placeholder="name@example.com"
                                value="{{ old('email') }}" required>
                            <label for="email">Email address</label>
                        </div>
                    </div>

                    <div class="input-group mb-4">
                        <span class="input-group-text"><i class="fas fa-lock fa-fw"></i></span>
                        <div class="form-floating">
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                required>
                            <label for="password">Password</label>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg fw-semibold">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            Sign In
                        </button>
                    </div>



                </form>
            </div>
        </div>
    </div>
@endsection
