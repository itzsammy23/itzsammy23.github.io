@extends('layouts.app')
<body style="background-image: url('/storage/profile/tools-2145770_1280.jpg')">

@section('content')
<div class="container ">
    <div class="row justify-content-center align-items-center">
        <div class="form-file col-md-10" >
                    <form method="GET" action="/search/result" onsubmit="return check();" name="select" id="select">
            
                        <div class="search-content">
                        <div class="form-group row d-block offset-2 pr-5 pt-3" >
                            <label for="service" class="heading col-md-12">{{ __('What service might you be looking for today?') }}</label>
                            <div class="col-md-10">
                                <input id="input-service" type="text" class="form-control @error('service')
                                 is-invalid @enderror" name="service" value="{{ old('service') }}" 
                                 required autocomplete="service" placeholder="Services..." autofocus>
                                @error('service')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row d-block offset-2 pr-5 pt-3" >
                            <label for="state" class="small-header col-md-4">{{ __('State') }}</label>
                            <div class="col-md-10">
                                <input id="input-state" type="text" class="form-control @error('state')
                                 is-invalid @enderror" name="state" value="{{ old('state') }}" 
                                 required autocomplete="state" placeholder="Your state.." autofocus>
                                @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                      

                        <div class="form-group row d-block offset-2 pr-5 pt-3">
                            <label for="area" class="small-header col-md-4 col-form-label">{{ __('Area') }}</label>
            
                            <div class="col-md-10">
                                <input id="input-area" type="area" class="form-control @error('area') 
                                is-invalid @enderror" name="area" value="{{ old('area') }}"
                                 required autocomplete="area" placeholder="Your area..">
                                <span id="error-area" class="error"></span>
                                @error('area')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="find row offset-2 pb-5">
                            <div class="col-md-6">
                                <button class="btn" type="submit">SEARCH</button>
</div>
                    </div>
                    </div>
                </div>
            </div>
@endsection
</body>
