@extends('layouts.app')

@section('content')
<div class="card mt-5">
    <h2 class="card-header">Edit Task</h2>
    <div class="card-body">
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Task Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $task->name }}" required>
            </div>
            <div class="form-group">
                <label for="project_id">Project</label>
                <select name="project_id" id="project_id" class="form-control" required>
                    @foreach($projects as $project)
                    <option value="{{ $project->id }}" {{ $task->project_id == $project->id ? 'selected' : '' }}>
                        {{ $project->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary mr-2">
                    <i class="fa fa-times"></i> Cancel
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Update Task
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
