@extends('layouts.app')
<body style="background-image: url('/storage/profile/envelopes198022.jpeg')">
@section('content')
<div class="container verify-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="last-step"> One last step </div>
        <div align="center" class="mail-image"><img src="/storage/profile/letters-1132703_640.png"></div>
        <div class="verify-content">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},

                    <form class="d-block pt-3" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-3 m-2">{{ __('click here to request another') }}</button>.
                    </form>
        <div>
        </div>
    </div>
</div>
@endsection
</body>
