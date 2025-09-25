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
        <label class="form-label">Owner ID</label>
        <input type="number" name="owner_id" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Flat ID</label>
        <input type="number" name="flat_id" class="form-control" required>
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Create</button>
        <a href="{{ route('admin.tenants.index') }}" class="btn btn-link">Cancel</a>
    </div>
</form>
@endsection

