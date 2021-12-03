<?php

namespace App\Http\Controllers\apis\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\traits\apiTrait;
class ProfileController extends Controller
{
    use apiTrait;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    { 
        $user = Auth::guard('sanctum')->user();
        $token = $request->header('authorization');
        $user->token = $token;
        return $this->returnData(compact('user'));
    }
}
