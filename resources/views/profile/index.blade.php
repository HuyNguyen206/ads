@extends('layouts.app')
@section('content')
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

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    Change password
                                </div>
                                <div class="card-body">
                                    <form action="{{route('profile.update-password')}}" method="post" >
                                        @csrf
                                        @method('patch')
                                        <div class="form-group">
                                            <label for="">Current password</label>
                                            <input type="password" value="{{old('old_password')}}" class="form-control @error('old_password') is-invalid @enderror" name="old_password" >
                                            @error('old_password')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">New password</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                            @error('password')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Confirm password</label>
                                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                                            @error('password_confirmation')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="Update password" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
@endsection
