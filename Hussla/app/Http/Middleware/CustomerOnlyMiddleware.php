<?php

namespace App\Http\Middleware;

use Closure;

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
            return redirect('/customer/login');
        }
        return $next($request);
    }
}
