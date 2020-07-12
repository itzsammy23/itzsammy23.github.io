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
			<div class="name pt-3"><h3><i class="fas fa-building"></i> : {{ $user->businessname }}</h3></div>
			<div class="motto pt-1"><p><i class="fab fa-pied-piper"></i> <em>{{ $user->businessmotto }}</em></p></div>
			<div class="address pt-1"> <p><i class="fas fa-map-marker-alt"></i> : <b>{{ $user->businessaddress }}</p></b></div>
            <div class="phone pt-3"><p><b>Profile views: </b><span>{{ $user->profile->views }}</span></p></div>
            <div class="pt-2"><p><b>Rating <i class="fas fa-star"></i> :
         </b><span> @if($user->profile->rating !== "0")
                             {{ round($user->profile->rating, 2) }} / 5 @else Not Rated @endif</span></p></div>
</div>

@can('update', $user->profile) 
            @if(session('days_left') == 0)
            <div align="center" class="alert alert-danger" role="alert">
                        Your subscription has expired.Switch to a paid yearly subscription. Your services won't be shown when customers search for service
                        providers until your subscription is renewed.

                        <div align="center">
                    <form method="POST" action="/pay" accept-charset="UTF-8">
                    @csrf
                    <input type="hidden" name="email" value="{{$user->email}}"> 
            <input type="hidden" name="userID" value="{{$user->id}}">
            <input type="hidden" name="amount" value="360000">
            <input type="hidden" name="quantity" value="1">
            <input type="hidden" name="currency" value="NGN">
            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> 

            <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
              <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
              </button>

                    </form>
              </div>
                        </div>
           
           @elseif(session('days_left') <= 7 && session('days_left') != 0)
           <div align="center" class="alert alert-danger" role="alert">
                        You have {{session('days_left')}} days left on your subscription.
                        </div>

              <div align="center">
                    <form method="POST" action="/pay" accept-charset="UTF-8">
                    @csrf
                    <input type="hidden" name="email" value="{{$user->email}}"> 
            <input type="hidden" name="userID" value="{{$user->id}}">
            <input type="hidden" name="amount" value="360000">
            <input type="hidden" name="quantity" value="1">
            <input type="hidden" name="currency" value="NGN">
            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> 

            <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
              <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
              </button>

                    </form>
              </div>


            @else
            <div align="center" class="alert alert-success" role="alert">
                        You have {{session('days_left')}} days left on your subscription.
                        </div>

            
            @endif

            <div align="center">
              <p>Refer 20 people and get a free one year subscription</p>
              <a href="/request/referral-link/{{ $user->hussla_id }}">Request Referral Link</a>
            </div>
            @if(session('requested_referral') == true)
            <div align="center" class="alert alert-success" role="alert">
                     Your referral link is <span>http://127.0.0.1:8000/refer/token/{{$user->referral->referral_id}}
                     </span>
                        </div>
            @endif

            <div class="pt-5 view-all-comments"><a href="/view/comments/{{$user->id}}">Check out your reviews</a></div>
            <div class="pt-5 pb-5 edit"><a href="/profile/{{$user->id}}/edit">Edit Your Profile</a></div>
@endcan
    </div>
</div>
</div>

@endsection
<!--<script>
function copy() {
  var copyText = document.getElementById("input");
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  document.execCommand("copy");

  alert("Copied the text: " + copyText.value);
}
</script> -->

