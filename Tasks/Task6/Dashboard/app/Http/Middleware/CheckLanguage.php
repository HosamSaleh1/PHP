<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\traits\apiTrait;
use Illuminate\Support\Facades\App;

class CheckLanguage
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
        $language = $request->header('accept-language');
        if(is_null($language)){
            return $this->returnErrorMessage('You Must Send Accept-Language Key');
        }
        $supportedLanguages = ['ar','en'];
        if(!in_array($language,$supportedLanguages)){
            return $this->returnErrorMessage('This Language Not Supported');
        }
        App::setLocale($language);
        return $next($request);
    }
}
