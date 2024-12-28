@extends('layouts.app')

@section('content')
    <div class="card mt-5">
        <h2 class="card-header">Projects</h2>
        <div class="card-body">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-success" href="{{ route('projects.create') }}"> <i class="fa fa-plus"></i> Create New
                    project</a>
            </div>

            <table class="table table-bordered table-striped mt-4">
                <thead>
                    <tr>
                        <th width="80px">No</th>
                        <th>Name</th>
                        <th width="250px">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($projects as $project)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $project->name }}</td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{ route('projects.show', $project->id) }}"><i
                                        class="fa-solid fa-list"></i> Show</a>

                                <a class="btn btn-primary btn-sm" href="{{ route('projects.edit', $project->id) }}"><i
                                        class="fa-solid fa-pen-to-square"></i> Edit</a>

                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#deleteModal{{ $project->id }}">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>

                                <div class="modal fade" id="deleteModal{{ $project->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="deleteModalLabel{{ $project->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $project->id }}">Delete
                                                    Confirmation</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this Project?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">There are no data.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

            {!! $projects->links() !!}

        </div>
    </div>
@endsection
