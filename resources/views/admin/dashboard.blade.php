@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 m-0">Admin Dashboard</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-danger">Logout</button>
    </form>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Total Owners</h5>
                <h2 class="mb-0">{{ $stats['total_owners'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Total Tenants</h5>
                <h2 class="mb-0">{{ $stats['total_tenants'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title">Total Buildings</h5>
                <h2 class="mb-0">{{ $stats['total_buildings'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h5 class="card-title">Total Bills</h5>
                <h2 class="mb-0">{{ $stats['total_bills'] }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Recent Owners</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @foreach($recent_owners as $owner)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $owner->name }}</strong>
                            <br>
                            <small class="text-muted">{{ $owner->email }}</small>
                        </div>
                        <a href="{{ route('admin.owners.show', $owner) }}" class="btn btn-sm btn-outline-primary">View</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Recent Tenants</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @foreach($recent_tenants as $tenant)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $tenant->name }}</strong>
                            <br>
                            <small class="text-muted">{{ $tenant->email }}</small>
                        </div>
                        <a href="{{ route('admin.tenants.show', $tenant) }}" class="btn btn-sm btn-outline-primary">View</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.owners.index') }}" class="btn btn-primary">Manage Owners</a>
                    <a href="{{ route('admin.tenants.index') }}" class="btn btn-success">Manage Tenants</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
