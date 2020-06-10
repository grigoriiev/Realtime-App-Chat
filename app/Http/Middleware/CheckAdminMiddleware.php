<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminMiddleware
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
        if(Auth::check() && $this->isAdmin ())
        {
            return $next($request);
        }

        abort(404);

    }

    public function isAdmin (){

        $user=Auth::user()->roles();

        foreach ($user as $key => $value ){
           if( $value== "ADMIN"){
               return true;
           }

        }

    }

}
