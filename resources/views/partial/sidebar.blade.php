<div class="card ">
    @php
        $user = auth()->user();
    @endphp
    <div class="card-body ">
        @if($image = $user->getFirstMediaUrl('avatar'))
            <img class="mx-auto d-block img-thumbnail" src="{{$image}}" width="130">
        @else
            <img class="mx-auto d-block img-thumbnail" src="/img/man.jpg" width="130">
        @endif
        <p class="text-center"><b>{{$user->name}}</b></p>
    </div>
    <hr style="border:2px solid blue;">
    <div class="vertical-menu">
        <a href="{{route('ads.index')}}" class="{{request()->routeIs('ads.index') ? 'ads-sidbar-active' : ''}}">Dashboard</a>
        <a href="{{route('profile.index')}}" class="{{request()->routeIs('profile.index') ? 'ads-sidbar-active' : ''}}">Profile</a>
        <a href="{{route('ads.create')}}" class="{{request()->routeIs('ads.create') ? 'ads-sidbar-active' : ''}}">Create ads</a>
        <a href="#">Published ads</a>
        <a href="#">Pending ads</a>
        <a href="#" class="">Message</a>
    </div>

</div>
@push('css')
    <style>
        .vertical-menu a {
            background-color: #fff;
            color: #000;
            display: block;
            padding: 12px;
            text-decoration: none;
        }

        .vertical-menu a:hover {
            background-color: red;
            color: #fff;
        }
        .ads-sidbar-active {
            background-color: red !important;
            color: #fff !important;
        }
    </style>
@endpush

