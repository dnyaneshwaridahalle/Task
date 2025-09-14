@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fa fa-tachometer-alt fa-fw"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa fa-user-circle fa-fw"></i> My Profile
                            </a>
                        </li>

                        @if ($user->hasAnyRole(['admin', 'moderator']))
                            <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted">Moderation Tools</h6>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fa fa-check-double fa-fw"></i> Content
                                    Moderation</a>
                            </li>
                        @endif

                        @if ($user->hasRole('admin'))
                            <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted">Administration</h6>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fa fa-search fa-fw"></i> Search Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fa fa-users-cog fa-fw"></i> User Management</a>
                            </li>
                        @endif
                    </ul>

                    <ul class="nav flex-column mt-auto pt-3">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out-alt fa-fw"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>

                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body text-center p-5">
                        <h2 class="fw-bold">Welcome, {{ $user->name }}!</h2>
                        <p class="text-muted fs-5">You are logged in as <span
                                class="fw-semibold text-primary">{{ ucfirst($user->role->name) }}</span>.</p>
                        <p class="mt-4">Select an option from the sidebar to get started.</p>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
