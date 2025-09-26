@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3">Edit Bill</h1>
<form method="POST" action="{{ route('owner.bills.update', $bill) }}" class="row g-3">
    @csrf
    @method('PUT')
    <div class="col-md-6">
        <label class="form-label">Flat</label>
        <select name="flat_id" class="form-select" required>
            <option value="">Select a flat</option>
            @foreach($flats as $flat)
                <option value="{{ $flat->id }}" {{ $bill->flat_id == $flat->id ? 'selected' : '' }}>
                    {{ $flat->building->name ?? 'Building' }} - Flat {{ $flat->number }}
                    @if($flat->floor)
                        (Floor {{ $flat->floor }})
                    @endif
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Tenant (optional)</label>
        <select name="tenant_id" class="form-select">
            <option value="">Select a tenant</option>
            @foreach($tenants as $tenant)
                <option value="{{ $tenant->id }}" {{ $bill->tenant_id == $tenant->id ? 'selected' : '' }}>
                    {{ $tenant->name }} - {{ $tenant->flat->building->name ?? 'Building' }} Flat {{ $tenant->flat->number }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-select" required>
            <option value="">Select a category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $bill->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
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

