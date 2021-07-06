@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Profile Settings</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                            </div>

                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <img class="card-img-top"
                                        src="{{ auth()->user()->image == null ? asset('user.png') : asset('storage/'.auth()->user()->image) }}"
                                        alt="User image">
                                    <div class="card-body">
                                        <h5 class="card-title text-capitalize">{{ auth()->user()->name }}</h5>
                                        <p class="card-text">{{ auth()->user()->email }}</p>
                                        <a href="/" class="btn btn-primary">Go home</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                                    <h6 class="mb-3 text-primary">Personal Details</h6>
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" name="name"
                                                        value="{{ old('name', auth()->user()->name) }}">
                                                    @error('name')<span
                                                        class="text-danger">{{ $message }}</span>@enderror
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control" name="email"
                                                        value="{{ old('email', auth()->user()->email) }}">
                                                    @error('email')<span
                                                        class="text-danger">{{ $message }}</span>@enderror
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                                                    <label>Image</label>
                                                    <div id="img_view" class="text-center border" style="height: 150px; width: 150px;">
                                                        <label for="image-upload" class="text-center mt-5 border bg-light p-2">Choose File</label>
                                                        <input type="file" name="image" id="image-upload" class="d-none" onchange="imageView(window.URL.createObjectURL(this.files[0]))"/>
                                                    </div>
                                                    @error('image')<span
                                                        class="text-danger">{{ $message }}</span>@enderror
                                                </div>

                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function imageView(img) {
            $('#img_view').css('background-image', 'url(' + img + ')');
            $('#img_view').css('background-size', 'cover');
            $('#img_view').css('background-position', 'center');
        }
    </script>
@endsection
