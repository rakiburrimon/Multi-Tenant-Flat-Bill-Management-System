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
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Save</button>
        <a href="{{ route('admin.tenants.index') }}" class="btn btn-link">Cancel</a>
    </div>
</form>
@endsection

