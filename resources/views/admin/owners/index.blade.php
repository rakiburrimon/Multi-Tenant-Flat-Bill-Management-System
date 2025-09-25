@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 m-0">Owners</h1>
    <a href="{{ route('admin.owners.create') }}" class="btn btn-primary">Create Owner</a>
    
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($owners as $owner)
        <tr>
            <td>{{ $owner->id }}</td>
            <td>{{ $owner->name }}</td>
            <td>{{ $owner->email }}</td>
            <td class="d-flex gap-2">
                <a href="{{ route('admin.owners.show', $owner) }}" class="btn btn-sm btn-outline-secondary">View</a>
                <a href="{{ route('admin.owners.edit', $owner) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                <form method="POST" action="{{ route('admin.owners.destroy', $owner) }}" onsubmit="return confirm('Delete owner?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $owners->links() }}
@endsection

