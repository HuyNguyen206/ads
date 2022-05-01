@extends('layouts.app')
@section('content')

    <div class="container ">
        <div class="row ">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header text-white text-center" style="background-color: red;">Filter ::</div>
                    <div class="card-body">
                        @forelse($subCategories as $subCategory)
                        <p>
                            @if(request()->routeIs('frontend.root-categories'))
                                <a href="{{route('frontend.subcategories', [$subCategory->parent->slug, $subCategory->slug])}}">{{$subCategory->name}}</a>
                            @else
                                <a href="{{route('frontend.child-categories', [$subCategory->parent->slug, $subCategory->slug])}}">{{$subCategory->name}}</a>
                            @endif
                        </p>
                        @empty

                        @endforelse
                    </div>

                </div>
                <div class="card mt-2">
                    <div class="card-header">
                        Filter price
                    </div>
                    <div class="card-body">
                        <form action="" method="get">
                            @csrf
                            <div class="form-group">
                                <label for="">Minimum price</label>
                                <input type="text" name="minPrice" class="form-control" value="{{request()->minPrice}}">
                            </div>
                            <div class="form-group">
                                <label for="">Maximum price</label>
                                <input type="text" name="maxPrice" class="form-control" value="{{request()->maxPrice}}">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Find" class="form-control btn btn-secondary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    @forelse($ads as $ad)
                        <div class="col-3">
                            <img width="200" height="130" src="{{$ad->getFirstMediaUrl('ads.feature_image')}}" alt="">
                            <p class="text-center card-footer">
                                {{$ad->name}} / USD {{number_format($ad->price, 2)}}
                            </p>
                        </div>
                    @empty
                        This category dont have any ads
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection
