<div class="card ">
    @php
        $user = auth()->user();
    @endphp
    <div class="card-body ">
        @if($image = $user->getAvatar())
            <img class="mx-auto d-block img-thumbnail" src="{{$image}}" width="130">
        @else
            <img class="mx-auto d-block img-thumbnail" src="/img/man.jpg" width="130">
        @endif
        <p class="text-center"><b>{{$user->name}}</b></p>
    </div>
    <hr style="border:2px solid blue;">
    <div class="vertical-menu">
        <a href="{{route('ads.index')}}" class="{{request()->routeIs('ads.index') && !request()->has('published') ? 'ads-sidebar-active' : ''}}">Dashboard</a>
        <a href="{{route('profile.index')}}" class="{{request()->routeIs('profile.index') ? 'ads-sidebar-active' : ''}}">Profile</a>
        <a href="{{route('ads.create')}}" class="{{request()->routeIs('ads.create') ? 'ads-sidebar-active' : ''}}">Create ads</a>
        <a href="{{route('ads.index', ['published' => true])}}" @class(['ads-sidebar-active' => request()->routeIs('ads.index') && request()->boolean('published')])>Published ads</a>
        <a href="{{route('ads.ads-saved')}}" @class(['ads-sidebar-active' => request()->routeIs('ads.ads-saved')])>Ads saved</a>
        <a href="{{route('ads.index', ['published' => false])}}" @class(['ads-sidebar-active' => request()->routeIs('ads.index') && request()->has('published') && !request()->boolean('published')])>Pending ads</a>
        <a class="{{request()->routeIs('message.index') ? 'ads-sidebar-active' : ''}}" href="{{ route('message.index') }}">
            Message
        </a>
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
        .ads-sidebar-active {
            background-color: red !important;
            color: #fff !important;
        }
    </style>
@endpush

