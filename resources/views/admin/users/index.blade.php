@extends('layouts.admin')

@section('content')
    <div class="panel-card">
        <h5 class="mb-3">Users & Roles</h5>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead><tr><th>Name</th><th>Email</th><th>Role</th><th class="text-end">Actions</th></tr></thead>
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form method="POST" action="/admin/users/{{ $user->id }}" class="d-flex gap-2">
                                @csrf @method('PUT')
                                <select name="role" class="form-control form-control-sm" style="max-width:120px">
                                    <option value="user" @selected($user->role === 'user')>User</option>
                                    <option value="admin" @selected($user->role === 'admin')>Admin</option>
                                </select>
                                <button class="btn btn-sm btn-outline-dark">Update</button>
                            </form>
                        </td>
                        <td class="text-end">
                            <form method="POST" action="/admin/users/{{ $user->id }}" onsubmit="return confirm('Delete user?')" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-muted">No users found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $users->links() }}
    </div>
@endsection

