@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('home') }}" class="btn-link">Back</a>
                        <h4 class="text-center">{{ __('User List') }}</h4>
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
                                            <th>Email</th>
                                            <th>N.o Assigned Task</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $data)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->email }}</td>
                                                <td>
                                                    {{ count($data->tasks) }}
                                                </td>
                                                <td>
                                                    @if (count($data->tasks) > 0)
                                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                                        data-target="#view{{ $data->id }}">View Tasks</button>
                                                    @endif
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


    @foreach ($users as $data)
        <div class="modal fade" id="view{{ $data->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Task list of - {{ $data->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        @foreach ($data->tasks as $task)
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                <div class="card bg-light text-dark">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $loop->iteration }} - {{ $task->name }}</h5>
                                        <p class="card-text">{{ $task->description }}</p>
                                        <p class="card-text">Total time : {{ $task->hours }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
