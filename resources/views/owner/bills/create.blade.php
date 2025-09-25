@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3">Create Bill</h1>
<form method="POST" action="{{ route('owner.bills.store') }}" class="row g-3">
    @csrf
    <div class="col-md-6">
        <label class="form-label">Flat ID</label>
        <input type="number" name="flat_id" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Tenant ID (optional)</label>
        <input type="number" name="tenant_id" class="form-control">
    </div>
    <div class="col-md-6">
        <label class="form-label">Category ID</label>
        <input type="number" name="category_id" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Amount</label>
        <input type="number" step="0.01" name="amount" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Due Date</label>
        <input type="date" name="due_date" class="form-control">
    </div>
    <div class="col-12">
        <label class="form-label">Remarks</label>
        <textarea name="remarks" class="form-control" rows="3"></textarea>
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Create</button>
        <a href="{{ route('owner.bills.index') }}" class="btn btn-link">Cancel</a>
    </div>
</form>
@endsection

