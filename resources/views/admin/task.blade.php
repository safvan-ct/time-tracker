@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('home') }}" class="btn-link">Back</a>
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addTask">Add Task</button>
                        <h4 class="text-center">{{ __('Tasks') }}</h4>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Assign Task</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tasks as $data)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->description }}</td>
                                                <td>
                                                    @if ($data->user)
                                                        {{ $data->user->name }}
                                                    @else
                                                        <form action="{{ route('task.assign', $data->id) }}" method="post">
                                                            @csrf
                                                            <div class="form-group row">
                                                                <div class="col-sm-12 col-md-8">
                                                                    <select class="form-control w-100" name="assign" required>
                                                                        <option value="">Select user</option>
                                                                        @foreach ($users as $user)
                                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-12 col-md-4 ">
                                                                    <button type="submit" class="btn btn-success">Assign</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit{{ $data->id }}">Edit</button>

                                                    <a class="btn btn-danger"  onclick="confirmAction({{ $data->id }}, 'task')"
                                                        data-action="{{ $data->id }}" message="Delete the data">
                                                        Delete
                                                    </a>

                                                    <form style="display: none" id="task-{{ $data->id }}" method="post"
                                                        action="{{ route('task.destroy', $data->id) }}">
                                                        @csrf @method('delete')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addTask" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('task.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-form-label">Task name:</label>
                            <input type="text" class="form-control" name="name" required value="{{ old('name') }}">
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Description:</label>
                            <textarea class="form-control" name="description">{{ old('description') }}</textarea>
                            @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($tasks as $data)
        <div class="modal fade" id="edit{{ $data->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Task - {{ $data->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('task.update', $data->id) }}" method="POST">
                        @csrf @method('put')
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-form-label">Task name:</label>
                                <input type="text" class="form-control" name="name" required value="{{ old('name', $data->name) }}">
                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Description:</label>
                                <textarea class="form-control" name="description">{{ old('description', $data->description) }}</textarea>
                                @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
