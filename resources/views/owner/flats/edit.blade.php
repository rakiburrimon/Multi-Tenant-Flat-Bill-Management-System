@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3">Edit Flat</h1>
<form method="POST" action="{{ route('owner.flats.update', $flat) }}" class="row g-3">
    @csrf
    @method('PUT')
    <div class="col-md-6">
        <label class="form-label">Number</label>
        <input type="text" name="number" class="form-control" value="{{ $flat->number }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Floor</label>
        <input type="number" name="floor" class="form-control" value="{{ $flat->floor }}">
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3">{{ $flat->description }}</textarea>
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Save</button>
        <a href="{{ route('owner.flats.index') }}" class="btn btn-link">Cancel</a>
    </div>
</form>
@endsection

