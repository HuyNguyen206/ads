@extends('backend.layouts.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">


            <h3>Edit Category</h3>
            <div class="row justify-content-center">
                <div class="col-md-10">

                    <div class="card">
                        <div class="card-body">

                            <form class="forms-sample" action="{{route('sub-categories.update', $category->slug)}}" method="post" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="{{old('name', $category->name)}}" class="form-control @error('name') is-invalid @enderror"
                                           placeholder="name of category">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>

                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="image">Parent category</label>
                                    <select name="parent_id" id="" class="form-control @error('parent_id') is-invalid @enderror">
                                        <option value="">--Select category--</option>
                                        @foreach($categories as $cat)
                                            <option @if(old('parent_id', $category->parent_id) == $cat->id) selected @endif value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>

                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                           name="image">
                                    @if($image = $category->getFirstMediaUrl('category'))
                                        <img src="{{$image}}" style="width: 200px" alt="">
                                     @endif
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>

                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
