@extends('layouts.app')
<body style="background-color: #ffffff;">
@section('content')
<div class="container">
<div class="row justify-content-center align-items-center">
    <div class="content col-md-12">
            <div class="profile-image col-md-12 pt-4">
                <img class="d-block mx-auto rounded-circle" src="/storage/{{ $user->profile->image }}">
                <span class='userId'>{{ $user->id }}</span>
        </div>
        <div class="content-text">
        <div class="pt-5"><h2>{{ $user->firstname }} {{ $user->lastname }}</h2></div>
			<div class="name pt-3"><h3><i class="fas fa-building"></i> : {{ $user->businessname }}</h3></div>
			<div class="motto pt-2"><p><i class="fab fa-pied-piper"></i> <em>{{ $user->businessmotto }}</em></p></div>
			<div class="address pt-1"><i class="fas fa-map-marker-alt"></i> : <span id="address">{{ $user->businessaddress }}</span></div>
            <div class="phone pt-3"><p><i class="fas fa-phone-alt"></i> : <span>+234{{ $user->businessphone }}</span></p></div>
            <div class="location pt-2"></div>
</div>
<div class="contact pt-3" align="center">
<h2 align="center" style="font-weight: bold;">Contact:</h2>
                <a href="sms:+234{{$user->businessphone}}" class="ml-4"><i class="fas fa-sms" aria-hidden="true"></i></a> &nbsp;
                <a href="tel:+234{{$user->businessphone}}"><i class="fas fa-phone-alt" aria-hidden="true" ></i></a>
			</div>

<div class="rate pt-5 pb-3" align="center">
				<p style="color: #000d1a; font-size: 23px; font-weight: bold;">Rate Hussla:</p><br>
			<i class="fas fa-star fa-8x" data-index = "0" id="starOne"></i>
			<i class="fas fa-star fa-8x" data-index = "1" id="starTwo"></i>
			<i class="fas fa-star fa-8x" data-index = "2" id="starThree"></i>
			<i class="fas fa-star fa-8x" data-index = "3" id="starFour"></i> 
			<i class="fas fa-star fa-8x" data-index = "4" id="starFive"></i><br>
			<span id="message"></span>
            </div>
            
            <div align="center" style="font-size: 18px"><a href="/view/comments/{{ $user->id }}"
             class="font-weight-bold">See reviews for this service provider</a></div>

             <div class="row justify-content-center align-items-center">
                 <div class="comment col-md-8 pt-5">
                     <form method="POST" action="/view/profile/{{$user->id}}">
                     @csrf
                     <label for="review" class="col-md-4 col-form-label">{{ __('Post a review') }}</label>
                     <input type="hidden" name="customerdetails" value='{{session("user_agent")}}'>
                     <textarea name="comment" placeholder="Write a review for this service provider.."></textarea>
                     @if (session('posted'))
                        <div class="alert alert-success alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ __('Your review has been posted.') }}
                        </div>
                    @endif
                     <button type="submit" class="btn mt-2 mb-4">Post</button>

                     
                    </form>
                </div>
            </div>
    </div>
</div>
</div>

@endsection
</body>