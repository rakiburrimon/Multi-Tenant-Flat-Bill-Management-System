@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 m-0">Bills</h1>
    <a href="{{ route('owner.bills.create') }}" class="btn btn-primary">Create Bill</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Flat</th>
            <th>Category</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Due</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bills as $bill)
        <tr>
            <td>{{ $bill->id }}</td>
            <td>{{ $bill->flat_id }}</td>
            <td>{{ $bill->category_id }}</td>
            <td>{{ number_format((float)$bill->amount, 2) }}</td>
            <td><span class="badge bg-{{ $bill->status === 'paid' ? 'success' : ($bill->status === 'overdue' ? 'danger' : 'secondary') }}">{{ $bill->status }}</span></td>
            <td>{{ $bill->due_date }}</td>
            <td class="d-flex gap-2">
                <a href="{{ route('owner.bills.show', $bill) }}" class="btn btn-sm btn-outline-secondary">View</a>
                <a href="{{ route('owner.bills.edit', $bill) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                @if($bill->status !== 'paid')
                <form method="POST" action="{{ route('owner.bills.pay', $bill) }}">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-sm btn-success" type="submit">Mark Paid</button>
                </form>
                @endif
                <form method="POST" action="{{ route('owner.bills.destroy', $bill) }}" onsubmit="return confirm('Delete bill?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $bills->links() }}
@endsection

