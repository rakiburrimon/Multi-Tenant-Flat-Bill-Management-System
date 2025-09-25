@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3">Create Category</h1>
<form method="POST" action="{{ route('owner.categories.store') }}" class="row g-3">
    @csrf
    <div class="col-md-6">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3"></textarea>
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Create</button>
        <a href="{{ route('owner.categories.index') }}" class="btn btn-link">Cancel</a>
    </div>
</form>
@endsection

