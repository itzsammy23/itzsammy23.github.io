<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use PayStack;

class PaymentController extends Controller
{
    public function redirectToGateway()
    {
        return paystack()->getAuthorizationUrl()->redirectNow();
    }

    public function handleGatewayCallback(User $user)
    {
        $paymentDetails = paystack()->getPaymentData();
        $payment_client_email = $paymentDetails["data"]["customer"]["email"];
        $data = [
            "usingFreeSubscription" => "false",
            "usingPaidSubscription" => "true",
            "isEligible" => "true",
            "updated_at" => date("Y-m-d h:i:s"),
        ];
        $client = User::where('email', $payment_client_email)->update($data);
        $user = User::whereIn('email', [$payment_client_email])->pluck("id")->first();
        
        return redirect("/profile/{$user}");
    }

}
