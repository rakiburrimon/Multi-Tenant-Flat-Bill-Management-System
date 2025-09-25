@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 m-0">Tenants</h1>
    <a href="{{ route('admin.tenants.create') }}" class="btn btn-primary">Create Tenant</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tenants as $tenant)
        <tr>
            <td>{{ $tenant->id }}</td>
            <td>{{ $tenant->name }}</td>
            <td>{{ $tenant->email }}</td>
            <td>{{ $tenant->phone }}</td>
            <td class="d-flex gap-2">
                <a href="{{ route('admin.tenants.show', $tenant) }}" class="btn btn-sm btn-outline-secondary">View</a>
                <a href="{{ route('admin.tenants.edit', $tenant) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                <form method="POST" action="{{ route('admin.tenants.destroy', $tenant) }}" onsubmit="return confirm('Delete tenant?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    
</table>

{{ $tenants->links() }}
@endsection

