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
                    <h4>Manage Ads</h4>
                    <div class="row justify-content-center">


                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">


                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Stt</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($ads as $ad)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td><a href="{{route('ads.show-detail', $ad->slug)}}">{{$ad->name}}</a></td>
                                                    <td>
                                                        <button class="btn btn-danger" onclick="if(confirm('Are you sure to delete this item?')) {document.getElementById('ads-saved-{{$ad->id}}').submit()}" >Remove</button>
                                                        <form method="post" id="ads-saved-{{$ad->id}}" action="{{route('ads.ads-saved.delete', $ad->id)}}">
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

@endsection
