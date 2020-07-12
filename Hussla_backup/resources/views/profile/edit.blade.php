@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="profile-image pb-4 pt-4">
                <img class="d-block mx-auto rounded-circle" src="/storage/{{ $user->profile->image }}">
        </div>

        <div class="image-upload-form pb-5">
        <form action="/profile/{{$user->id}}/edit" method="post" enctype = "multipart/form-data">
        @csrf
          <label class="custom-file">
            <p>Choose Profile Picture</p>
          <input type="file" name="profilepic">
        </label>
          <button type="submit" class="upload-button">Upload</button>
          @error('upload')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
        </form>
      </div>

        <form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="post">
            @csrf
            @method('PATCH')

            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h2>Edit Profile</h2>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                        <div class="pb-2">
                        <label for="firstname" class="w-100 col-form-label caption">First Name</label>


                        <input id="firstname" type="text"
                               class="form-control @error('firstname') is-invalid @enderror"
                               value="{{ old('firstname') ?? $user->firstname}}" name="firstname" autocomplete="firstname" autofocus>

                        @error('firstname')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        </div>
                        
                        <div class="pb-2">
                        <label for="lastname" class="w-100 col-form-label caption">Last Name</label>


                        <input id="lastname" type="text"
                               class="form-control @error('lastname') is-invalid @enderror"
                               value="{{ old('lastname') ?? $user->lastname}}" name="lastname" autocomplete="lastname" autofocus>

                        @error('lastname')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        </div>

                        <div class="pb-2">
                        <label for="email" class="w-100 col-form-label caption">Email address</label>


                            <input id="email" type="text"
                             class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email')  ?? $user->email  }}" name="email" autocomplete="email" autofocus>

                                @error('email')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                              </span>
                            @enderror

                        </div>

                       
                        
                        <div class="pb-2">
                        <label for="phone" class="w-100 col-form-label caption">Phone</label>


                        <input id="phone" type="text"
                               class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone')  ?? $user->phone  }}" name="phone" autocomplete="phone" autofocus>

                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        </div>

                        <div class="pb-2">
                            <label for="businessname" class="w-100 col-form-label caption">Business Name</label>


                            <input id="businessname" type="text"
                                   class="form-control @error('businessname') is-invalid @enderror"
                                   value="{{ old('businessname')  ?? $user->businessname  }}" name="businessname" autocomplete="businessname" autofocus>

                            @error('businessname')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                        
                        <div class="pb-2">
                            <label for="businessinfo" class="w-100 col-form-label caption">Business Info</label>


                            <input id="businessinfo" type="text"
                                   class="form-control @error('businessinfo') is-invalid @enderror"
                                   value="{{ old('businessinfo')  ?? $user->businessinfo  }}" name="businessinfo" autocomplete="businessinfo" autofocus>

                            @error('businessinfo')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>

                        </div>
                        <div class="col-6">
                        <div class="form-group row">
                        <div class="col-12">
                        <div class="pb-2">
                            <label for="businessphone" class="w-100 col-form-label caption">Business phone</label>


                            <input id="businessphone" type="text"
                                   class="form-control @error('businessphone') is-invalid @enderror"
                                   value="{{ old('businessphone')  ?? $user->businessphone  }}" name="businessphone" autocomplete="businessphone" autofocus>

                            @error('businessphone')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                        
                            <label for="businessaddress" class="w-100 col-form-label caption">Business Address</label>


                            <input id="businessaddress" type="text"
                                   class="form-control @error('businessaddress') is-invalid @enderror"
                                   value="{{ old('businessaddress')  ?? $user->businessaddress ?? ''  }}" name="businessaddress" autocomplete="businessaddress" autofocus>

                            @error('businessaddress')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <div class="pt-2">
                            <label for="specialize" class="w-100 col-form-label caption">Specialization</label>
                            <select name="specialize"  class="select-option @error('workperiod') is-invalid @enderror" >
				<option value="" id="selects">Choose Specialization</option>
				<option value="Air-condition repair" id="selects">Air-condition repair</option>
				<option value="Childcare services" id="selects">Childcare Services</option>
				<option value="Electronics" id="selects">Electronics</option>
				<option value="Event Planner" id="selects">Event Planner</option>
				<option value="Haircuts" id="selects">Haircuts</option>\
				<option value="Homecooking Chef" id="selects">Homecooking Chef</option>
				<option value="House-Keeping" id="selects">House-Keeping</option>
				<option value="Hair Styling" id="selects">Hair Styling</option>
				<option value="Phone repair" id="selects">Phone Repair</option>
				<option value="Photography" id="selects">Photography</option>
				<option value="Plumbing" id="selects">Plumbing</option>
				<option value="Tailoring" id="selects">Tailoring</option>
				<option value="TV Repair" id="selects">TV Repair</option>
				<option value="Vehicle repair" id="selects">Vehicle repair</option>
				<option value="Woodwork" id="selects">Woodwork</option>
				
                </select>

                            @error('specialize')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
</div>

                    <div class="pt-2">
                        <label for="businessmotto" class="w-100 col-form-label caption">Business Motto</label>


                        <input id="businessmotto" type="text"
                               class="form-control @error('businessmotto') is-invalid @enderror"
                               value="{{ old('businessmotto') ?? $user->businessmotto}}" name="businessmotto" autocomplete="businessmotto" autofocus>

                        @error('businessmotto')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        </div>
                            

                            <div class="pt-2">
                            <label for="state" class="w-100 col-form-label caption">State</label>

                            <input id="state" type="text"
                                   class="form-control @error('state') is-invalid @enderror"
                                   value="{{ old('state')  ?? $user->state ?? '' }}" name="state" autocomplete="state" autofocus>

                            @error('state')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            </div>

                            <div class="pt-2">
                            <label for="area" class="w-100 col-form-label caption">Area</label>

                            <input id="area" type="text"
                                   class="form-control @error('area') is-invalid @enderror"
                                   value="{{ old('area')  ?? $user->area ?? '' }}" name="area" autocomplete="area" autofocus>

                            @error('area')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            </div>

                        </div>
                        </div>
                    </div>
                    <div class="row pl-4 w-100">
                                <button class="btn w-100" type="submit">Update Profile</button>
                    </div>
</div>
                </div>
            </div>


        </form>
    </div>
@endsection
