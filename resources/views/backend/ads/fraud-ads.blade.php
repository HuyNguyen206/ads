@extends('backend.layouts.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
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
                                                    <th>Ad</th>
                                                    <th>Email</th>
                                                    <th>Reason</th>
                                                    <th>Message</th>
                                                    <th>Report at</th>
                                                    <th>Delete</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($ads as $ad)
                                                    <tr>
                                                        <td>
                                                            <a href="{{route('ads.show-detail', $ad->advertisement->slug)}}">
                                                                {{$ad->advertisement->name}}<br>
                                                            </a>
                                                        </td>
                                                        <td>{{$ad->email}}</td>
                                                        <td>{{$ad->reason}}</td>
                                                        <td>{{$ad->message}}</td>
                                                        <td>{{$ad->created_at->toFormattedDateString()}}</td>
                                                        <td>
                                                            @php
                                                            $formId = "{$ad->id}_delete_fraud";
                                                            @endphp
                                                            <button
                                                                onclick="if(confirm('Do you want to delete this fraud?')) {document.getElementById('{{$formId}}').submit()}"
                                                                class="btn btn-danger">Delete
                                                            </button>
                                                            <form id="{{$formId}}"
                                                                  action="{{route('ads-fraud.destroy', $ad->id)}}"
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
