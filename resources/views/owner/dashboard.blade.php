@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 m-0">Owner Dashboard</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-danger">Logout</button>
    </form>
</div>

<div class="row mb-4">
    <div class="col-md-2">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h6 class="card-title">Buildings</h6>
                <h4 class="mb-0">{{ $stats['total_buildings'] }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h6 class="card-title">Flats</h6>
                <h4 class="mb-0">{{ $stats['total_flats'] }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h6 class="card-title">Tenants</h6>
                <h4 class="mb-0">{{ $stats['total_tenants'] }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h6 class="card-title">Total Bills</h6>
                <h4 class="mb-0">{{ $stats['total_bills'] }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h6 class="card-title">Unpaid</h6>
                <h4 class="mb-0">{{ $stats['unpaid_bills'] }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card bg-dark text-white">
            <div class="card-body">
                <h6 class="card-title">Overdue</h6>
                <h4 class="mb-0">{{ $stats['overdue_bills'] }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Recent Bills</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Flat</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Due Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent_bills as $bill)
                            <tr>
                                <td>{{ $bill->id }}</td>
                                <td>{{ $bill->flat_id }}</td>
                                <td>{{ number_format((float)$bill->amount, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ $bill->status === 'paid' ? 'success' : ($bill->status === 'overdue' ? 'danger' : 'secondary') }}">
                                        {{ $bill->status }}
                                    </span>
                                </td>
                                <td>{{ $bill->due_date }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Your Buildings</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @foreach($buildings as $building)
                    <div class="list-group-item">
                        <strong>{{ $building->name }}</strong>
                        <br>
                        <small class="text-muted">{{ $building->address }}</small>
                        <br>
                        <small class="text-muted">{{ $building->flats->count() }} flats</small>
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
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('owner.flats.index') }}" class="btn btn-primary">Manage Flats</a>
                    <a href="{{ route('owner.bills.index') }}" class="btn btn-success">Manage Bills</a>
                    <a href="{{ route('owner.categories.index') }}" class="btn btn-info">Bill Categories</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
