@extends('layouts.app')
@section('content')

    <div class="container ">
        <div class="row ">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-white text-center">
                        <div id="ads-{{$ad->id}}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @if($image = $ad->getFirstMediaUrl('ads.feature_image'))
                                    <div class="carousel-item active">
                                        <img src="{{$image}}" class="d-block w-100" alt="...">
                                    </div>
                                @endif
                                @if($image = $ad->getFirstMediaUrl('ads.first_image'))
                                    <div class="carousel-item">
                                        <img src="{{$image}}" class="d-block w-100" alt="...">
                                    </div>
                                @endif
                                @if($image = $ad->getFirstMediaUrl('ads.second_image'))
                                    <div class="carousel-item">
                                        <img src="{{$image}}" class="d-block w-100" alt="...">
                                    </div>
                                @endif
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#ads-{{$ad->id}}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#ads-{{$ad->id}}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                     <p>
                         {!! $ad->description !!}
                     </p>
                    </div>

                </div>
                <div class="card">
                    <div class="card-header">
                        More info
                    </div>
                    <div class="card-body">
                        <p>
                            Country: {{$ad->country->name}}
                        </p>
                        <p>
                            State: {{$ad->state->name}}
                        </p>
                        <p>
                            City: {{$ad->city->name}}
                        </p>
                        <p>
                            Product condition: {{$ad->product_condition}}
                        </p>
                        @if ($link = $ad->link)
                        <p>
                          {!! displayLinkFromUrl($link) !!}
                        </p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
               <h1>{{$ad->name}}</h1>
                <p>Price: ${{$ad->price}}</p> USD, {{$ad->price_status}}
                <p>Posted: {{$ad->created_at->diffForHumans()}}</p>
                <p>Posted: {{$ad->listing_location}}</p>
                <hr>
                <img src="{{$ad->seller->getFirstMediaUrl('avatar')}}" width="200" height="200" alt="">
                <p>Seller name: {{$ad->seller->name}}</p>
            </div>
        </div>
    </div>

@endsection
