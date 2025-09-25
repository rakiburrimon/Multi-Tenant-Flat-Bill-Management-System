@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 m-0">Bill Categories</h1>
    <a href="{{ route('owner.categories.create') }}" class="btn btn-primary">Create Category</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->description }}</td>
            <td class="d-flex gap-2">
                <a href="{{ route('owner.categories.edit', $category) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                <form method="POST" action="{{ route('owner.categories.destroy', $category) }}" onsubmit="return confirm('Delete category?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $categories->links() }}
@endsection

