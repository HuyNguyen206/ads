@extends('layouts.app')
@section('content')
    @php
        $user = auth()->user();
    @endphp
    <div class="main-panel container">
        <div class="row">
            <div class="col-md-3">
                @include('partial.sidebar')
            </div>
            <div class="col-md-9">
                <div class="content-wrapper">
                    @include('backend.alert.message')
                    <h4>Manage Profile</h4>
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    Update profile
                                </div>
                                <div class="card-body">
                                    <form action="{{route('user-profile-information.update')}}" method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <input type="text" name="name"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   value="{{$user->name}}">
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Avatar</label>
                                            <input type="file" accept="image/*" class="form-control @error('avatar') is-invalid @enderror" name="avatar" >
                                            @if($image = $user->getFirstMediaUrl('avatar'))
                                                <img src="{{$image}}" alt="" width="200" height="130">
                                            @endif
                                            @error('avatar')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="text" class="form-control" readonly value="{{$user->email}}">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary form-control">Update profile
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    Change password
                                </div>
                                <div class="card-body">
                                    <form action="{{route('user-password.update')}}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="form-group">
                                            <label for="">Current password</label>
                                            <input type="password" value="{{old('current_password')}}"
                                                   class="form-control @error('current_password') is-invalid @enderror"
                                                   name="current_password">
                                            @error('current_password')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">New password</label>
                                            <input type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password">
                                            @error('password')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Confirm password</label>
                                            <input type="password"
                                                   class="form-control @error('password_confirmation') is-invalid @enderror"
                                                   name="password_confirmation">
                                            @error('password_confirmation')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="Update password"
                                                   class="form-control btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
@endsection
