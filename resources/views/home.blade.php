@extends('layouts.app')

@section('content')
    <div>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{asset('slider/slider1.png')}}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('slider/slider2.png')}}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('slider/slider3.png')}}" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        @foreach($rootCategories as $rc)
        <div class="container mt-5">
        <span>
            <h1>{{$rc->name}}</h1>
            <a href="{{route('frontend.root-categories', $rc->slug)}}" class="float-right">View all</a>

        </span>
            <div id="carouselExampleFade" class="carousel slide" data-bs-ride="carousel" data-interval="2500">
                <div class="carousel-inner">
                    @foreach($rc->advertisementsRoot->chunk(4) as $chunks)
                    <div class="carousel-item {{$loop->first ? 'active' : ''}}">
                        <div class="row">
                            @foreach($chunks as $ad)
                            <div class="col-3">
                                <a href="{{route('ads.show-detail', $ad->slug)}}">
                                    <img src="{{$ad->getFirstMediaUrl('ads.feature_image')}}" style="object-fit: cover" class="img-thumbnail">
                                    <p class="text-center  card-footer" style="color: blue;">
                                        {{$ad->name}} /${{$ad->price}}
                                    </p>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
{{--                    <div class="carousel-item">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-3">--}}
{{--                                <img src="/product/car2.jpg" class="img-thumbnail">--}}
{{--                                <p class="text-center  card-footer">--}}
{{--                                    Name of product/$500--}}
{{--                                </p>--}}
{{--                            </div>--}}

{{--                            <div class="col-3">--}}
{{--                                <img src="/product/car2.jpg" class="img-thumbnail">--}}
{{--                                <p class="text-center  card-footer">--}}
{{--                                    Name of product/$500--}}
{{--                                </p>--}}
{{--                            </div>--}}

{{--                            <div class="col-3">--}}
{{--                                <img src="/product/car2.jpg" class="img-thumbnail">--}}
{{--                                <p class="text-center  card-footer">--}}
{{--                                    Name of product/$500--}}
{{--                                </p>--}}
{{--                            </div>--}}

{{--                            <div class="col-3">--}}
{{--                                <img src="/product/car2.jpg" class="img-thumbnail">--}}
{{--                                <p class="text-center  card-footer">--}}
{{--                                    Name of product/$500--}}
{{--                                </p>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}



                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        @endforeach
    </div>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
<style>
    /* Medium devices (landscape tablets, 768px and up) */
    @media only screen and (min-width: 768px) and (max-width: 991px) {
        .carousel-inner {
            height: 300px;
        }

        .carousel-item, .carousel-item img {
            height: 300px;
            width:100%;
        }

    }

    /* Extra small devices (phones, 600px and down) */
    @media only screen and (max-width: 767px) {
        .carousel-inner {
            height: 140px;
        }

        .carousel-item, .carousel-item img {
            height: 140px;
            width:100%
        }
    }
</style>
@endsection
