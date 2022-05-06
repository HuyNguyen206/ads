@extends('layouts.app')
@section('content')
    <div class="container ">
        <conversation user-id="{{auth()->id()}}"></conversation>
    </div>
@endsection
