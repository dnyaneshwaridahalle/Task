@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">


            <main class="">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>

                <!-- Welcome Card -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body text-center p-5">
                        <h2 class="fw-bold">Welcome, {{ auth()->user()->name }}!</h2>
                        <p class="text-muted fs-5">
                            You are logged in as <span
                                class="fw-semibold text-primary">{{ ucfirst(auth()->user()->role->name) }}</span>.
                        </p>
                        <p class="mt-3">Select an option from the sidebar to get started.</p>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card shadow-sm rounded-4 p-4 text-center">
                            <h3 class="fw-bold">25</h3>
                            <p class="text-muted mb-0">Total Users</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm rounded-4 p-4 text-center">
                            <h3 class="fw-bold">12</h3>
                            <p class="text-muted mb-0">Active Moderators</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm rounded-4 p-4 text-center">
                            <h3 class="fw-bold">5</h3>
                            <p class="text-muted mb-0">Pending Approvals</p>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="card shadow-sm rounded-4 p-4">
                        <h5 class="fw-bold">Recent Activities</h5>
                        <ul class="list-group list-group-flush mt-3">
                            <li class="list-group-item">New user registered: John Doe</li>
                            <li class="list-group-item">Moderator updated content</li>
                            <li class="list-group-item">Admin changed user role</li>
                        </ul>
                    </div>
                </div>

            </main>
        </div>
    </div>
@endsection
