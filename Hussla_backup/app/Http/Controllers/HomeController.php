<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use App\Referral;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user()->hussla_id;
        $referral_count = auth()->user()->referral->referral_count;
        

        if($referral_count == 12) {
            $data = [
                "usingFreeSubscription" => "false",
                "usingPaidSubscription" => "true",
                "isEligible" => "true",
                "updated_at" => date('Y-m-d h:i:s'),
            ];
            auth()->user()->update($data);
        };
    
        return redirect("/profile/{$user}");
    }


    public function random() {
        $id =request()->route('user');
                
        session(["requested_referral" => true]);
        return redirect("/profile/{$id}");
    }

    public function redirect() {
        $token = request()->route('token');
        $id = Referral::where('referral_id', $token)->pluck('user_id')->first();
        session(["id" => $id]);

        return redirect('/register');
    }

}
