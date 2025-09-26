@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3">Create Tenant</h1>
<form method="POST" action="{{ route('admin.tenants.store') }}" class="row g-3">
    @csrf
    <div class="col-md-6">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="col-md-6">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control">
    </div>
    <div class="col-md-6">
        <label class="form-label">Owner</label>
        <select name="owner_id" class="form-select" required>
            <option value="">Select an owner</option>
            @foreach($owners as $owner)
                <option value="{{ $owner->id }}">{{ $owner->name }} ({{ $owner->email }})</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Flat</label>
        <select name="flat_id" class="form-select" required>
            <option value="">Select a flat</option>
            @foreach($flats as $flat)
                <option value="{{ $flat->id }}">
                    {{ $flat->building->name ?? 'Building' }} - Flat {{ $flat->number }}
                    @if($flat->floor)
                        (Floor {{ $flat->floor }})
                    @endif
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Create</button>
        <a href="{{ route('admin.tenants.index') }}" class="btn btn-link">Cancel</a>
    </div>
</form>
@endsection

