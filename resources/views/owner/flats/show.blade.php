@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 m-0">Flat #{{ $flat->id }}</h1>
    <div>
        <a href="{{ route('owner.flats.edit', $flat) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('owner.flats.index') }}" class="btn btn-link">Back</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-md-3 fw-bold">Number</div>
            <div class="col-md-9">{{ $flat->number }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 fw-bold">Floor</div>
            <div class="col-md-9">{{ $flat->floor }}</div>
        </div>
        <div class="row mb-2">
            <div class="col-md-3 fw-bold">Description</div>
            <div class="col-md-9">{{ $flat->description }}</div>
        </div>
    </div>
</div>
@endsection

