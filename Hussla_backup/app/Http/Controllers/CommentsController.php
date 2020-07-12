<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Customer;
use Illuminate\Support\Facades\Hash;

class CommentsController extends Controller
{
    public function login(User $user) {
        return view('comment.login', compact('user'));
    }   

    protected function redirect(User $user) {
        $email = request('email');
        $customer_email = Customer::where('email', $email)->value('password');
        $customer_firstname = Customer::whereIn('email', [$email])->value('firstname');
        $customer_lastname = Customer::whereIn('email', [$email])->value('lastname');
        
        request()->validate([
            'email' => ['required', 'email', 'exists:sqlite.customers,email'],
            'password' => ['required', function ($attribute, $value, $fail) use ($customer_email) {
                if(!\Hash::check($value, $customer_email)) {
                    return $fail(__('Your password entry is incorrect.'));
                }
            }],
        ]);
        
        $customer_name = "$customer_firstname {$customer_lastname}";
        session(['user_agent' =>  $customer_name, 'logged_in' => true]);
        return redirect("/view/profile/{$user->id}");
}
}
