@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 m-0">Flats</h1>
    <a href="{{ route('owner.flats.create') }}" class="btn btn-primary">Create Flat</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Number</th>
            <th>Floor</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($flats as $flat)
        <tr>
            <td>{{ $flat->id }}</td>
            <td>{{ $flat->number }}</td>
            <td>{{ $flat->floor }}</td>
            <td class="d-flex gap-2">
                <a href="{{ route('owner.flats.show', $flat) }}" class="btn btn-sm btn-outline-secondary">View</a>
                <a href="{{ route('owner.flats.edit', $flat) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                <form method="POST" action="{{ route('owner.flats.destroy', $flat) }}" onsubmit="return confirm('Delete flat?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $flats->links() }}
@endsection

