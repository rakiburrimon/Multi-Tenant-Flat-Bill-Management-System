@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3">Edit Bill</h1>
<form method="POST" action="{{ route('owner.bills.update', $bill) }}" class="row g-3">
    @csrf
    @method('PUT')
    <div class="col-md-6">
        <label class="form-label">Category ID</label>
        <input type="number" name="category_id" class="form-control" value="{{ $bill->category_id }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Amount</label>
        <input type="number" step="0.01" name="amount" class="form-control" value="{{ $bill->amount }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Due Date</label>
        <input type="date" name="due_date" class="form-control" value="{{ $bill->due_date }}">
    </div>
    <div class="col-12">
        <label class="form-label">Remarks</label>
        <textarea name="remarks" class="form-control" rows="3">{{ $bill->remarks }}</textarea>
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Save</button>
        <a href="{{ route('owner.bills.show', $bill) }}" class="btn btn-link">Cancel</a>
    </div>
</form>
@endsection

