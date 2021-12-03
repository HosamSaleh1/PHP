<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\traits\apiTrait;
class VerifyApiPassword
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
        if(env('API_PASSWORD') !== $request->header('api-password')){
            return $this->returnErrorMessage('Bad Request',400);
        }
        return $next($request);
    }
}
