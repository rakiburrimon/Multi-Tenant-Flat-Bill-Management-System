@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3">Edit Tenant</h1>
<form method="POST" action="{{ route('admin.tenants.update', $tenant) }}" class="row g-3">
    @csrf
    @method('PUT')
    <div class="col-md-6">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{ $tenant->name }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ $tenant->email }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control" value="{{ $tenant->phone }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Owner</label>
        <select name="owner_id" class="form-select" required>
            <option value="">Select an owner</option>
            @foreach($owners as $owner)
                <option value="{{ $owner->id }}" {{ $tenant->house_owner_id == $owner->id ? 'selected' : '' }}>
                    {{ $owner->name }} ({{ $owner->email }})
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Flat</label>
        <select name="flat_id" class="form-select" required>
            <option value="">Select a flat</option>
            @foreach($flats as $flat)
                <option value="{{ $flat->id }}" {{ $tenant->flat_id == $flat->id ? 'selected' : '' }}>
                    {{ $flat->building->name ?? 'Building' }} - Flat {{ $flat->number }}
                    @if($flat->floor)
                        (Floor {{ $flat->floor }})
                    @endif
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Save</button>
        <a href="{{ route('admin.tenants.index') }}" class="btn btn-link">Cancel</a>
    </div>
</form>
@endsection

