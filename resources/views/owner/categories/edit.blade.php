@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3">Edit Category</h1>
<form method="POST" action="{{ route('owner.categories.update', $category) }}" class="row g-3">
    @csrf
    @method('PUT')
    <div class="col-md-6">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{ $category->name }}">
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3">{{ $category->description }}</textarea>
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Save</button>
        <a href="{{ route('owner.categories.index') }}" class="btn btn-link">Cancel</a>
    </div>
</form>
@endsection

