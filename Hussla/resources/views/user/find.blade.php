<body style="background-color: #f2f2f2;">
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-group row d-flex offset-2 search-field">
            <form method="GET" action="/find/user" style="width: 80%">
            <input id="parameter" type="parameter" class="form-control col-md-8 @error('parameter') is-invalid @enderror"
             name="parameter" value="{{ old('parameter') }}" required autocomplete="parameter" placeholder="Search for a business or service provider"autofocus>
             <button type="submit" name="search" class="search-btn"><i class="fas fa-search icon"></i></button>
            </div>
        </div>
        <div class="col-md-8">
            @foreach($users as $user) 
            <div class="card mb-4" style="border-radius: 20px;">
                <div class="card-body">
                    <div class="row">
                        <img src="/storage/{{$user->profile->image}}" class="col-md-4 rounded-circle float-md-left">
                        <div class="search-result col-md-6">
                            <div class="name pt-2">{{ $user->businessname }}</div>
                            <div class="info pt-2">{{ $user->businessinfo }}</div>
                            <div class="address pt-2"><i class="fas fa-map-marker-alt"></i> : {{ $user->businessaddress }}</div>
                            <div class="pt-2"><i class="fas fa-star"></i> : {{ $user->profile->rating }} / 5</div>

                            <div class="pt-3"><a href="/view/profile/{{$user->id}}" class="btn">Contact</a></div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{$users->withQueryString()->links()}}
                </div>
            </div>
        </div>
    </div>
</div>    

@endsection
</body>