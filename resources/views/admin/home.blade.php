@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Admin Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 mb-3">
                                <a href="{{ route('task.index') }}" class="text-decoration-none text-white">
                                    <div class="card bg-primary">
                                        <div class="card-body">
                                            <h5 class="card-title">Tasks</h5>
                                            <p class="card-text">Add tasks</p>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 mb-3">
                                <a href="{{ route('user.list') }}" class="text-decoration-none text-white">
                                    <div class="card bg-primary">
                                        <div class="card-body">
                                            <h5 class="card-title">User list</h5>
                                            <p class="card-text">Users and their tasks</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
