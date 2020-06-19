<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerRegisterController extends Controller
{

    protected function register()
    {

        request()->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    
        $customer = Customer::create([
            'firstname' => request('firstname'),
            'lastname' =>  request('lastname'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
        ]);
        
        $customer_name = "$customer->firstname {$customer->lastname}";
        session(['user_agent' =>  $customer_name]);
        
        return redirect('/servicefinder');
    
    }
    
        
}
