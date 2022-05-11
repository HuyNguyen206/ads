@extends('backend.layouts.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            @include('backend.alert.message')
            <h4>Manage ads</h4>
            <div class="row justify-content-center">
                <div class="col-md-12">
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
                                                    <th>Seller</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Price</th>
                                                    <th>Status</th>
                                                    <th>Published date</th>
                                                    <th>View</th>
                                                    <th>Delete</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($ads as $ad)
                                                    <tr>
                                                        <td>
                                                            <a href="{{route('user.ads', $ad->seller->email)}}">
                                                                {{$ad->seller->name}}<br>
                                                                @if($avatar = $ad->seller->getAvatar())
                                                                    <img src="{{$avatar}}" width="40" height="40"
                                                                         style="border-radius: 50%" alt="">
                                                                @endif
                                                            </a>
                                                        </td>
                                                        <td style="width: 200px; height: 130px">
                                                            <div id="ads-{{$ad->id}}" class="carousel slide"
                                                                 data-bs-ride="carousel">
                                                                <div class="carousel-inner">
                                                                    @if($image = $ad->getFirstMediaUrl('ads.feature_image'))
                                                                        <div class="carousel-item active">
                                                                            <img src="{{$image}}" class="d-block w-100"
                                                                                 alt="...">
                                                                        </div>
                                                                    @endif
                                                                    @if($image = $ad->getFirstMediaUrl('ads.first_image'))
                                                                        <div class="carousel-item">
                                                                            <img src="{{$image}}" class="d-block w-100"
                                                                                 alt="...">
                                                                        </div>
                                                                    @endif
                                                                    @if($image = $ad->getFirstMediaUrl('ads.second_image'))
                                                                        <div class="carousel-item">
                                                                            <img src="{{$image}}" class="d-block w-100"
                                                                                 alt="...">
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <button class="carousel-control-prev" type="button"
                                                                        data-bs-target="#ads-{{$ad->id}}"
                                                                        data-bs-slide="prev">
                                                                    <span class="carousel-control-prev-icon"
                                                                          aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Previous</span>
                                                                </button>
                                                                <button class="carousel-control-next" type="button"
                                                                        data-bs-target="#ads-{{$ad->id}}"
                                                                        data-bs-slide="next">
                                                                    <span class="carousel-control-next-icon"
                                                                          aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Next</span>
                                                                </button>
                                                            </div>
                                                        </td>
                                                        <td>{{$ad->name}}</td>
                                                        <td>USD {{number_format($ad->price, 2)}}</td>
                                                        <td>
                                                            @if($ad->is_published)
                                                                <span class="badge bg-success">Published</span>
                                                            @else
                                                                <span class="badge bg-info">Pending</span>
                                                            @endif
                                                        </td>
                                                        <td><a href="{{route('ads.show-detail', $ad->slug)}}"
                                                               class="btn btn-info">View</a></td>
                                                        <td>{{$ad->created_at->toFormattedDateString()}}</td>
                                                        @php
                                                            $formId = "deleteCategory_$ad->slug"
                                                        @endphp
                                                        <td>
                                                            <button
                                                                onclick="if(confirm('Do you want to delete this category?')) {document.getElementById('{{$formId}}').submit()}"
                                                                class="btn btn-danger">Delete
                                                            </button>
                                                            <form id="{{$formId}}"
                                                                  action="{{route('ads.destroy', $ad->slug)}}"
                                                                  method="post">
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
                                            <div>
                                                {!! $ads->links() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
