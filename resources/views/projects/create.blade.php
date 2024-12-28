@extends('layouts.app')

@section('content')
<div class="card mt-5">
    <h2 class="card-header">Create New Project</h2>
    <div class="card-body">
        <form action="{{ route('projects.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Project Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter project name" value="{{ old('name') }}" required>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('projects.index') }}" class="btn btn-secondary mr-2">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Submit
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
