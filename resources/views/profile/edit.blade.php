@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Please watch video </h2>
        <div class="row ">
            <div class="col-md-3">
                @include('ads.partial.sidebar')
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
                <form action="{{route('ads.update', $advertisement->slug)}}" method="post" enctype="multipart/form-data">@csrf
                    @method('put')
                    <div class="card">
                        <div class="card-header text-white" style="background-color: red">
                            Post your ad.
                        </div>
                        <div class="card-body">
                            <label for="file" class="mt-2"><b>Upload 3 Images</b></label>
                            <div class="form-inline form-group mt-1">
                                <div class="row">
                                    <image-preview current_img="{{$advertisement->getFirstMediaUrl('ads.feature_image')}}" name="feature_image"></image-preview>
                                    <image-preview current_img="{{$advertisement->getFirstMediaUrl('ads.first_image')}}" name="first_image"></image-preview>
                                    <image-preview current_img="{{$advertisement->getFirstMediaUrl('ads.second_image')}}" name="second_image"></image-preview>
                                </div>
                            </div>
                            <label for="file" class="mt-2"><b>Choose category</b></label>
                            <div class="form-inline form-group mt-1">
                                <category :selected_category_id="{{old('category_id', $advertisement->category_id)}}"
                                          :selected_sub_category_id="{{old('sub_category_id', $advertisement->sub_category_id)}}"
                                          :selected_child_category_id="{{old('child_category_id', $advertisement->child_category_id)}}"
                                          :categories="{{json_encode($rootCategories)}}"></category>

                            </div>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" value="{{old('name', $advertisement->name)}}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control">{{old('description', $advertisement->description)}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="description">Price</label>
                                <input type="text" name="price" class="form-control" value="{{old('price', $advertisement->price)}}">
                            </div>
                            <div class="form-group">
                                <label for="description">Price staus</label>
                                <select class="form-control" name="price_status">
                                    <option @if(old('price_status', $advertisement->price_status) === "negoitable") selected @endif value="negoitable">Negotiable</option>
                                    <option @if(old('price_status', $advertisement->price_status) === "fixed") selected @endif value="fixed">Fixed</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Product Condition</label>
                                <select class="form-control" name="product_condition">
                                    <option value="">Select </option>
                                    <option @if(old('product_condition', $advertisement->price_status) === "likenew") selected @endif  value="likenew">Looks like New</option>
                                    <option @if(old('product_condition', $advertisement->price_status) === "heavilyused") selected @endif  value="heavilyused">Heavily Used</option>
                                    <option @if(old('product_condition', $advertisement->price_status) === "new") selected @endif  value="new">New</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="location">Listing Location</label>
                                <input type="text" class="form-control" name="listing_location" value="{{old('listing_location', $advertisement->listing_location)}}">
                            </div>
                            <label for="file" class="mt-2"><b>Choose address</b></label>
                            <div class="form-inline form-group mt-1">
                                <address-ads :countries="{{json_encode($countries)}}"
                                             :selected_country_id="{{old('country_id', $advertisement->country_id)}}"
                                             :selected_state_id="{{old('state_id', $advertisement->state_id)}}"
                                             :selected_city_id="{{old('city_id', $advertisement->city_id)}}"
                                ></address-ads>
                            </div>
                            <div class="form-group">
                                <label for="location">Seller contact number</label>
                                <input type="number" class="form-control" name="phone_number" value="{{old('phone_number', $advertisement->phone_number)}}">
                            </div>
                            <div class="form-group">
                                <label for="location">Demo link of product(ie:youtube)</label>
                                <input type="text" class="form-control" name="link" value="{{old('link', $advertisement->link)}}">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger float-right" type="submit">Publish</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
