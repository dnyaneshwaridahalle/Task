@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>User Management</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="GET" action="{{ route('admin.user.management') }}" class="mb-4">
            <div class="row">
                <div class="col-md-6">
                    <select name="role_id" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Select Role --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ $selectedRole == $role->id ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        @if ($selectedRole)
            <form method="POST" action="{{ route('admin.user.permissions.update') }}">
                @csrf
                <input type="hidden" name="role_id" value="{{ $selectedRole }}">

                <div class="card">
                    <div class="card-body">
                        <h5>Permissions for Role</h5>

                        @foreach ($modules as $module)
                            <div class="mb-3">
                                <strong>{{ $module->name }}</strong>
                                <div class="form-check">
                                    @foreach ($permissions as $permission)
                                        {{-- Only show permission if this permission belongs to this module --}}
                                        @if (DB::table('role_module_permission')->where('module_id', $module->id)->where('permission_id', $permission->id)->exists() || auth()->user()->role_id == 1)
                                            {{-- Admin always sees all --}}
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="permissions[{{ $module->id }}][]"
                                                    value="{{ $permission->id }}" class="form-check-input"
                                                    {{ isset($roleModulePermissions[$module->id]) && in_array($permission->id, $roleModulePermissions[$module->id]) ? 'checked' : '' }}>
                                                <label class="form-check-label">{{ ucfirst($permission->name) }}</label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach



                        <button type="submit" class="btn btn-primary">Update Permissions</button>
                    </div>
                </div>
            </form>
        @endif
    </div>
@endsection
