@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center align-items-center">
    <div class="content col-md-12">
            <div class="profile-image col-md-12 pt-4">
                <img class="d-block mx-auto rounded-circle" src="/storage/{{ $user->profile->image }}">
        </div>
        <div class="content-text">
        <div class="pt-5"><h2>{{ $user->firstname }} {{ $user->lastname }}</h2></div>
			<div class="pt-3"><h3><i class="fas fa-building"></i> : {{ $user->businessname }}</h3></div>
			<div class="pt-1"><p><i class="fab fa-pied-piper"></i> <em>{{ $user->businessmotto }}</em></p></div>
			<div class="pt-1"> <p><i class="fas fa-map-marker-alt"></i> : <b>{{ $user->businessaddress }}</p></b></div>
            <div class="pt-3"><p><b>Profile views: </b><span>{{ $user->profile->views }}</span></p></div>
            <div class="pt-2"><p><b>Rating <i class="fas fa-star"></i> : </b><span>{{ $user->profile->rating }} / 5</span></p></div>
</div>

@can('update', $user->profile)    
            <div class="pt-5 view-all-comments"><a href="#">Check out your reviews</a></div>
            <div class="pt-5 pb-5 edit"><a href="/profile/{{$user->id}}/edit">Edit Your Profile</a></div>
@endcan
    </div>
</div>
</div>

@endsection