@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Search Users</h2>

        <form action="{{ route('admin.users.search.post') }}" method="POST" class="mb-4">
            @csrf
            <div class="input-group">
                <input type="text" name="query" class="form-control" placeholder="Search by name, email or username"
                    value="{{ old('query', $query ?? '') }}">
                <button class="btn btn-primary" type="submit">
                    <i class="fa fa-search"></i> Search
                </button>
            </div>
        </form>

        @isset($users)
            <div class="card shadow-sm">
                <div class="card-body">
                    @if ($users->count() > 0)
                        <!-- ✅ Responsive wrapper -->
                        <div class="table-responsive">
                            <table class="table table-striped align-middle text-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th>Username</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Location</th>
                                        @if ($hasPermission('content', 'view'))
                                            <th class="text-center">Actions</th>
                                        @endif

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                {{ $user->location ? ucfirst($user->location) : '-' }}
                                            </td>
                                            @if ($hasPermission('content', 'view'))
                                                <td class="text-center">
                                                    <!-- Delete Button -->
                                                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            @endif


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3 d-flex justify-content-center">
                            {{ $users->links('pagination::bootstrap-5') }}
                        </div>
                    @else
                        @if (!empty($query) || request('query'))
                            <p class="text-muted">No users found for "{{ $query ?? request('query') }}"</p>
                        @else
                            <p class="text-muted">No users found.</p>
                        @endif
                    @endif
                </div>
            </div>
        @endisset
    </div>
@endsection
