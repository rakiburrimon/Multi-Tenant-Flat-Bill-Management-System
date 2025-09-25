@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 m-0">Bill #{{ $bill->id }}</h1>
    <div>
        <a href="{{ route('owner.bills.edit', $bill) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('owner.bills.index') }}" class="btn btn-link">Back</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-md-3 fw-bold">Flat</div>
            <div class="col-md-9">{{ $bill->flat_id }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 fw-bold">Category</div>
            <div class="col-md-9">{{ $bill->category_id }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 fw-bold">Amount</div>
            <div class="col-md-9">{{ number_format((float)$bill->amount, 2) }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 fw-bold">Status</div>
            <div class="col-md-9"><span class="badge bg-{{ $bill->status === 'paid' ? 'success' : ($bill->status === 'overdue' ? 'danger' : 'secondary') }}">{{ $bill->status }}</span></div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 fw-bold">Due date</div>
            <div class="col-md-9">{{ $bill->due_date }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 fw-bold">Remarks</div>
            <div class="col-md-9">{{ $bill->remarks }}</div>
        </div>
        @if($bill->status !== 'paid')
        <form method="POST" action="{{ route('owner.bills.pay', $bill) }}" class="mt-3">
            @csrf
            @method('PUT')
            <button class="btn btn-success" type="submit">Mark as Paid</button>
        </form>
        @endif
    </div>
</div>
@endsection

