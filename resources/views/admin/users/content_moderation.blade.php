@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Content Moderation Tools</h2>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contents as $content)
                            <tr>
                                <td>{{ $content['id'] }}</td>
                                <td>{{ $content['title'] }}</td>
                                <td>{{ ucfirst($content['status']) }}</td>
                                <td>
                                    <button class="btn btn-success btn-sm">Approve</button>
                                    <button class="btn btn-danger btn-sm">Reject</button>
                                    <button class="btn btn-primary btn-sm">Edit</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
