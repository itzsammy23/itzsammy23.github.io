<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CustomerOnlyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if($request->customerdetails == null) {
           $requestUser = $request->route('user');
           $request_id = $requestUser->id;
            return redirect("/customer/login/comment/{$request_id}");
        }
        return $next($request);
    }
}
