@extends('layouts.app')

@section('content')
<div class="card mt-5">
    <h2 class="card-header">Project Details</h2>
    <div class="card-body">
        <div class="mb-3">
            <strong>Project Name:</strong> {{ $project->name }}
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{ route('projects.index') }}" class="btn btn-secondary btn-sm"><i class="fa-solid fa-arrow-left"></i> Back</a>
            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
        </div>
    </div>
</div>
@endsection
