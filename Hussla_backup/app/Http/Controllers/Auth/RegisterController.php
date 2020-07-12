<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = "/account/created-success";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255'],
            'businessname' => ['required', 'string', 'max:500'],
            'businessinfo' => ['required', 'string', 'max:1000'],
            'businessphone' => ['required', 'string', 'max:255'],
            'businessaddress' => ['required', 'string', 'max:1000'],
            'specialize' => 'required',
            'businessmotto' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'area' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if(session("id") != null) {
            $id = session("id");
            $user = User::where('id', $id)->get()->first();
            $referral_count = $user->referral->referral_count;
            $new_referral_count = $referral_count + 1;
    
    
            $user->referral()->update([
                'referral_count' => $new_referral_count,
            ]);
           };

        $idStr = Str::random(20);
        return User::create([
            'hussla_id' => $idStr,
            'firstname' => ucfirst($data['firstname']),
            'lastname' => ucfirst($data['lastname']),
            'email' => $data['email'],
            'phone' => $data['phone'],
            'businessname' => ucfirst($data['businessname']),
            'businessinfo' => ucfirst($data['businessinfo']),
            'businessphone' => $data['businessphone'],
            'businessaddress' => $data['businessaddress'],
            'specialize' => ucfirst($data['specialize']),
            'businessmotto' => ucfirst($data['businessmotto']),
            'state' => ucfirst($data['state']),
            'area' => ucfirst($data['area']),
            'password' => Hash::make($data['password']),
            'usingFreeSubscription' => 'true',
            'usingPaidSubscription' => 'false',
            'isEligible' => 'true',
        ]);
    }

}
