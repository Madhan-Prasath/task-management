@extends('layouts.app')

@section('content')
    <div class="card mt-5">
        <h2 class="card-header">Tasks</h2>
        <div class="card-body">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                <a class="btn btn-success" href="{{ route('tasks.create') }}">
                    <i class="fa fa-plus"></i> Create New Task
                </a>
            </div>

            <form method="GET" class="mb-4">
                <select name="project_id" class="form-control" onchange="this.form.submit()">
                    <option value="">All Projects</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}" {{ $projectId == $project->id ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
            </form>

            <ul id="task-list" class="list-group">
                @forelse ($tasks as $task)
                    <li class="list-group-item d-flex justify-content-between align-items-center mb-2"
                        data-id="{{ $task->id }}">
                        <div>
                            <i class="fa fa-arrows-alt handle"></i>
                            {{ $task->project->name }} - {{ $task->name }}
                            <span class="badge badge-secondary ml-2">Priority: {{ $task->priority }}</span>
                            <span class="text-muted ml-2">Created: {{ $task->created_at->diffForHumans() }}</span>
                        </div>
                        <div>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                data-target="#deleteModal{{ $task->id }}">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>

                            <div class="modal fade" id="deleteModal{{ $task->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="deleteModalLabel{{ $task->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $task->id }}">Delete
                                                Confirmation</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this Task?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="list-group-item">No tasks available.</li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .handle {
            margin-right: 10px;
            color: #6c757d;
            cursor: move;
            user-select: none;
        }

        .handle:hover {
            color: #000;
        }

        .sortable-placeholder {
            background-color: #f0f0f0;
            border: 1px dashed #ddd;
            height: 50px;
            margin-bottom: 10px;
        }

        .list-group-item {
            user-select: none;
        }

        .list-group-item.mb-2 {
            margin-bottom: 15px;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

    <script>
        $('#task-list').sortable({
            handle: '.handle',
            placeholder: 'sortable-placeholder',
            update: function(event, ui) {
                const order = $(this).sortable('toArray', {
                    attribute: 'data-id'
                });
                const projectId = $('select[name="project_id"]').val();
                $.ajax({
                    url: '{{ route('tasks.reorder') }}',
                    method: 'POST',
                    data: {
                        tasks: order,
                        project_id: projectId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        $('#task-list li').each(function(index) {
                            const priority = index + 1;
                            $(this).find('.badge').text('Priority: ' + priority);
                        });
                        toastr.success('Tasks reordered successfully!');
                    },
                    error: function() {
                        toastr.error('Failed to reorder tasks.');
                    }
                });
            }
        }).disableSelection();
    </script>
@endsection
