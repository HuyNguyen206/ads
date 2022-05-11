@extends('layouts.app')
@section('content')
    <div class="container ">
        <div class="row ">
            <div class="col-md-3">
                @include('backend.alert.message')
            </div>
            <div class="col-md-9">
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>
                                {{$error}}
                            </li>
                        @endforeach
                    </div>
                @endif
            </div>
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
                            <button class="carousel-control-prev" type="button" data-bs-target="#ads-{{$ad->id}}"
                                    data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#ads-{{$ad->id}}"
                                    data-bs-slide="next">
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
                <p>Listing location: {{$ad->listing_location}}</p>
                @auth
                    @php
                        $user = auth()->user();
                    @endphp
                    @if($ad->user_id !== $user->id)
{{--                        @if($user->isAlreadySaveThisAd($ad->id))--}}
{{--                            <p class="badge bg-success">Already save</p>--}}
{{--                        @else--}}
                            <save-ad :is-already-save="{{ $user->isAlreadySaveThisAd($ad->id)}}" ad-id="{{$ad->id}}"></save-ad>
{{--                        @endif--}}
                    @endif
                @endauth
                <hr>
                <img src="{{$ad->seller->getAvatar()}}" width="200" height="200" alt="">
                <p>Seller name: <a href="{{route('user.ads', $ad->seller->email)}}">{{$ad->seller->name}}</a></p>
                <show-phone-number number="{{$ad->phone_number}}"></show-phone-number>
                @php
                    $user = auth()->user()
                @endphp
                @auth
                    @if($ad->user_id !== $user->id)
                        <message :seller="{{json_encode($ad->seller)}}" sender_id="{{$user->id}}"
                                 ad_id="{{$ad->id}}"></message>
                    @endif
                @endauth
            <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reportAds">
                    Report ad
                </button>

                <!-- Modal -->
                <div class="modal fade" id="reportAds" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{route('ads.ads-report')}}" method="post">
                                <input type="hidden" name="ad_id" value="{{$ad->id}}">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Report ad</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Choose reason</label>
                                        <select name="reason" id="" class="form-control">
                                            <option value="wrong-category">Wrong category</option>
                                            <option value="fraud">Fraud</option>
                                            <option value="offensive">Offensive</option>
                                            <option value="duplicate">Duplicate</option>
                                            <option value="sexual-content">Sexual content</option>
                                        </select>
                                    </div>
                                @guest
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" class="form-control">
                                    </div>
                                @endguest
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea class="form-control" cols="30" rows="10" name="message"></textarea>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary form-control">
                                <button type="button" class="btn btn-secondary form-control" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div>
    <span id=”IDCommentsPostTitle” style=”display:none”></span>
</div>
@endsection
@push('js')
    <script>
    var idcomments_acct = 'huynguyen206';
    var idcomments_post_id = {{$ad->id}};
    var idcomments_post_url = '{{url()->current()}}';
    </script>

    <script type=”text/javascript” src=”http://www.intensedebate.com/js/genericCommentWrapperV2.js”></script>
@endpush
