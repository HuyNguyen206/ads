@extends('backend.layouts.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            @include('backend.alert.message')
            <h4>Manage Category</h4>
            <div class="row justify-content-center">


                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">


                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($categories as $category)
                                        <tr>
                                            <td>
                                                @if($image = $category->getFirstMediaUrl('category'))
                                                <img src="{{$image}}" alt="">
                                                @endif
                                            </td>
                                            <td>{{$category->name}}</td>
                                            <td> <a href="{{route('categories.edit', $category->slug)}}" class="btn btn-info"><i class="mdi mdi-table-edit"></i></a></td>
                                            @php
                                            $formId = "deleteCategory_$category->slug"
                                            @endphp
                                            <td><button onclick="if(confirm('Do you want to delete this category?')) {document.getElementById('{{$formId}}').submit()}" class="btn btn-danger"><i class="mdi mdi-delete"></i></button>
                                                <form id="{{$formId}}" action="{{route('categories.destroy', $category->slug)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                           <td rowspan="4">No data</td>
                                        </tr>
                                    @endforelse


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
