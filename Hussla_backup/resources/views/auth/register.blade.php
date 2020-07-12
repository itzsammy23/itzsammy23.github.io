@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="row justify-content-center align-items-center">
        <div class="form-file col-md-10" >
                    <form method="POST" action="{{ route('register') }}" onsubmit="return validateSlideFour();" name="register" id="register">
                        @csrf
                        <h2>Sign Up:</h2>
            
                        <div class="tab">
                        <div class="form-group row d-block offset-2 pr-5" >
                            <label for="firstname" class="col-md-4 caption">{{ __('First Name') }}</label>
                            <div class="col-md-10">
                                <input id="firstname" type="text" class="form-control @error('firstname')
                                 is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" 
                                 required autocomplete="firstname" placeholder="Your firstname.." autofocus>
                                <span id="error-firstname" class="error"></span>
                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row d-block offset-2 pr-5" >
                            <label for="lastname" class="col-md-4 caption">{{ __('Last Name') }}</label>
                            <div class="col-md-10">
                                <input id="lastname" type="text" class="form-control @error('lastname')
                                 is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" 
                                 required autocomplete="lastname" placeholder="Your lastname.." autofocus>
                                <span id="error-lastname" class="error"></span>
                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                      

                        <div class="form-group row d-block offset-2 pr-5">
                            <label for="email" class="col-md-4 caption col-form-label">{{ __('E-Mail Address') }}</label>
            
                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control @error('email') 
                                is-invalid @enderror" name="email" value="{{ old('email') }}"
                                 required autocomplete="email" placeholder="E-mail address">
                                <span id="error-email" class="error"></span>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row d-block offset-2 pr-5" >
                            <label for="phone" class="col-md-4 caption">{{ __('Phone') }}</label>
                            <div class="col-md-10">
                                <input id="phone" type="tel" class="form-control @error('phone') 
                                is-invalid @enderror" name="phone" value="{{ old('phone') }}" 
                                required autocomplete="phone" placeholder="Phone number"autofocus>
                                <span id="error-phone" class="error"></span>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
</div>
                        <div class="row">
                            <div class="col-md-10">
                        <input type="button" value="Next" onclick="validateSlideOne();" id="nextBtn">
                        </div>
                    </div>
                    </div>

                   <div class="tab">
                    <div class="form-group row d-block offset-2 pr-5" >
                            <label for="businessname" class="col-md-4 caption">{{ __('Business Name') }}</label>
                            <div class="col-md-10">
                                <input id="businessname" type="text" class="form-control @error('businessname') 
                                is-invalid @enderror" name="businessname" value="{{ old('businessname') }}"
                                 required autocomplete="businessname" placeholder="Name of your business.."autofocus>
                                <span id="error-businessname" class="error"></span>
                                @error('businessname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row d-block offset-2 pr-5" >
                            <label for="businessinfo" class="col-md-4 caption">{{ __('Business Info') }}</label>
                            <div class="col-md-10">
                                <input id="businessinfo" type="text" class="form-control @error('businessinfo') 
                                is-invalid @enderror" name="businessinfo" value="{{ old('businessinfo') }}"
                                 required autocomplete="businessinfo" placeholder="What is your business about?.."autofocus>
                                <span id="error-businessinfo" class="error"></span>
                                @error('businessinfo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="form-group row d-block offset-2 pr-5" >
                            <label for="businessphone" class="col-md-4 caption">{{ __('Business Phone') }}</label>
                            <div class="col-md-10">
                                <input id="businessphone" type="tel" class="form-control @error('businessphone') 
                                is-invalid @enderror"  name="businessphone" value="{{ old('businessphone') }}"
                                 required autocomplete="businessphone" placeholder="Business phone number.."autofocus>
                                <span id="error-businessphone" class="error"></span>
                                @error('businessphone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="form-group row d-block offset-2 pr-5" >
                            <label for="businessaddress" class="col-md-4 caption ">{{ __('Business Address') }}</label>
                            <div class="col-md-10">
                                <input id="businessaddress" type="tel" class="form-control @error('businessaddress') 
                                is-invalid @enderror"  name="businessaddress" value="{{ old('businessaddress') }}"
                                 required autocomplete="businessaddress" placeholder="Business address.."autofocus>
                                <span id="error-businessaddress" class="error"></span>
                                @error('businessaddress')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                        <input type="button" value="Previous" onclick="plusSlides(-1)" id="nextBtn">
                        <input type="button" value="Next" onclick="validateSlideTwo();" id="nextBtn">
                        </div>
                    </div>
                    </div>

                    <div class="tab">
                    <div class="form-group row d-block offset-2 pr-5" >
                            <label for="specialize" class="col-md-4 caption">{{ __('Specialization') }}</label>
                            <div class="col-md-10 pb-3">
                            <select name="specialize" class="select-option w-100">
				<option value="" id="selects">Choose Specialization</option>
                <option value="Air-condition repair" id="selects">Air-condition repair</option>
                <option value="Carpentry" id="selects">Carpentry</option>
				<option value="Childcare services" id="selects">Childcare Services</option>
				<option value="Electrical Repair" id="selects">Electrical Repair</option>
				<option value="Event Planning" id="selects">Event Planner</option>
				<option value="Haircuts" id="selects">Haircuts</option>\
				<option value="Homecooking" id="selects">Homecooking</option>
				<option value="House Keeping" id="selects">House Keeping</option>
				<option value="Hair Styling" id="selects">Hair Styling</option>
                <option value="Painting" id="selects">Painting</option>
				<option value="Phone repair" id="selects">Phone Repair</option>
				<option value="Photography" id="selects">Photography</option>
				<option value="Plumbing" id="selects">Plumbing</option>
				<option value="Tailoring" id="selects">Tailoring</option>
				<option value="TV Repair" id="selects">TV Repair</option>
				<option value="Vehicle repair" id="selects">Vehicle repair</option>
				
                </select>
</div>
                                @error('specialize')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                    
                        <div class="form-group row d-block offset-2 pr-5" >
                            <label for="businessmotto" class="col-md-4 caption">{{ __('Business Motto') }}</label>
                            <div class="col-md-10">
                                <input id="businessmotto" type="tel" class="form-control @error('businessmotto') 
                                is-invalid @enderror"  name="businessmotto" value="{{ old('businessmotto') }}"
                                 required autocomplete="businessmotto" placeholder="Business motto.."autofocus>
                                <span id="error-businessmotto" class="error"></span>
                                @error('businessmotto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row d-block offset-2 pr-5" >
                            <label for="state" class="col-md-4 caption">{{ __('State') }}</label>
                            <div class="col-md-10">
                                <input id="state" type="tel" class="form-control @error('state') 
                                is-invalid @enderror"  name="state" value="{{ old('state') }}"
                                 required autocomplete="state" placeholder="State located.."autofocus>
                                <span id="error-state" class="error"></span>
                                @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row d-block offset-2 pr-5" >
                            <label for="area" class="col-md-4 caption">{{ __('Area') }}</label>
                            <div class="col-md-10">
                                <input id="area" type="tel" class="form-control @error('area') 
                                is-invalid @enderror"  name="area" value="{{ old('area') }}"
                                 required autocomplete="area" placeholder="Area located.."autofocus>
                                <span id="error-area" class="error"></span>
                                @error('area')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                     

                        <div class="row">
                            <div class="col-md-10">
                        <input type="button" value="Previous" onclick="plusSlides(-1)" id="nextBtn">
                        <input type="button" value="Next" onclick="validateSlideThree();" id="nextBtn">
                        </div>
                    </div>
                    </div>

                    <div class="tab">
                        <div class="form-group  row d-block offset-2 pr-5">
                            <label for="password" class="col-md-4 caption col-form-label">{{ __('Password') }}</label>

                            <div class="col-md-10">
                                <input id="password" type="password" class="form-control @error('password') 
                                is-invalid @enderror" name="password" required autocomplete="new-password" 
                                placeholder="Enter your password">
                                <span id="error-password" class="error"></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row d-block offset-2 pr-5">
                            <label for="password-confirm" class="col-md-4 caption col-form-label">{{ __('Confirm Password') }}</label>

                            <div class="col-md-10">
                               <input id="password-confirm" type="password" class="form-control" 
                               name="password_confirmation" required autocomplete="new-password" placeholder="Re-enter your password">
                               <span id="error-confirm-password" class="error"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                        <input type="button" value="Previous" onclick="plusSlides(-1)" id="nextBtn">
                        <input type="button" value="Next" onclick="validateSlideFour();" id="nextBtn">
                        </div>
                    </div>
                    </div>

                    
                    <div class="row justify-content-center align-items-center">
                        <div class="col-sm-10 ">
                        <div style="text-align:center;margin-top:40px;">
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                        </div>
                    </div>
                    </form>
                </div>
</div>
@endsection
