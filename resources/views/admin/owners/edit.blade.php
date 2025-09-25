@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3">Edit Owner</h1>
<form method="POST" action="{{ route('admin.owners.update', $owner) }}" class="row g-3">
    @csrf
    @method('PUT')
    <div class="col-md-6">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{ $owner->name }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ $owner->email }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Password (leave blank to keep)</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Save</button>
        <a href="{{ route('admin.owners.index') }}" class="btn btn-link">Cancel</a>
    </div>
</form>
@endsection

