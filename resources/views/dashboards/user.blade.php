@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card shadow-sm rounded-4">
                    <div class="card-body text-center p-5">
                        <h2 class="fw-bold">Welcome, {{ $user->name }}!</h2>
                        <p class="text-muted fs-5">You are logged in as <span class="fw-semibold text-primary">User</span>.
                        </p>
                        <p class="mt-4">Explore your dashboard and access your features.</p>

                        <a href="{{ route('logout') }}" class="btn btn-danger mt-4"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
