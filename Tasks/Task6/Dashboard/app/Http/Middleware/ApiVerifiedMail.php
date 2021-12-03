<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\traits\apiTrait;

class ApiVerifiedMail
{
    use apiTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('sanctum')->user();
        // if(! $user){
        //     return $this->returnErrorMessage('Unauthorized',401);
        // }
        if(! $user->email_verified_at){
            return $this->returnErrorMessage('Your email address is not verified',403);
        }
        return $next($request);
    }
}
