@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 m-0">Owner #{{ $owner->id }}</h1>
    <div>
        <a href="{{ route('admin.owners.edit', $owner) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('admin.owners.index') }}" class="btn btn-link">Back</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-md-3 fw-bold">Name</div>
            <div class="col-md-9">{{ $owner->name }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 fw-bold">Email</div>
            <div class="col-md-9">{{ $owner->email }}</div>
        </div>
    </div>
    
</div>
@endsection

