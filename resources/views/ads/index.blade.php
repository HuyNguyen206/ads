@extends('backend.layouts.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            @include('backend.alert.message')
            <h4>Manage Ads</h4>
            <div class="row justify-content-center">


                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">


                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>View</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($ads as $ad)
                                        <tr>
                                            <td>
                                                @if($image = $ad->getFirstMediaUrl('ads'))
                                                <img src="{{$image}}" alt="">
                                                @endif
                                            </td>
                                            <td>{{$ad->name}}</td>
                                            <td>USD {{number_format($ad->price, 2)}}</td>
                                            <td>
                                                @if($ad->is_published)
                                                    <span class="badge badge-success">Published</span>
                                                @else
                                                    <span class="badge badge-info">Pending</span>
                                                @endif
                                            </td>
                                            <td> <a href="{{route('ads.edit', $ad->slug)}}" class="btn btn-primary"><i class="mdi mdi-table-edit"></i></a></td>
                                            <td> <a href="{{route('ads.show', $ad->slug)}}" class="btn btn-info"><i class="mdi mdi-table-settings"></i></a></td>
                                            @php
                                            $formId = "deleteCategory_$ad->slug"
                                            @endphp
                                            <td><button onclick="if(confirm('Do you want to delete this category?')) {document.getElementById('{{$formId}}').submit()}" class="btn btn-danger"><i class="mdi mdi-delete"></i></button>
                                                <form id="{{$formId}}" action="{{route('categories.destroy', $ad->slug)}}" method="post">
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
