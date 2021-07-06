@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('User Tasks') }}</div>

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
                                            <th>Start</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count(auth()->user()->tasks) == 0)
                                            <tr>
                                                <td colspan="3" class="text-center">No task sheduled</td>
                                            </tr>
                                        @endif
                                        @foreach (auth()->user()->tasks as $data)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->description }}</td>
                                                <td>
                                                    <button class="btn btn-success">Start</button>
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
@endsection
