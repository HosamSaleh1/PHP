<?php

namespace App\Http\Controllers\apis\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\traits\apiTrait;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use apiTrait;
    public function Login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (! Hash::check($request->password, $user->password)) {
            return $this->returnErrorMessage('The provided credentials are incorrect.',401);
        }
        $token = 'Bearer '.$user->createToken($request->device_name)->plainTextToken;
        $user->token = $token;
        if(! $user->email_verified_at){
            return $this->returnData(compact('user'),'User Not Verified',401);
        }
        return $this->returnData(compact('user'));
    }

    public function logoutAllDevices(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $user->tokens()->delete();
        return $this->returnSuccessMessage("User Has Been Successfully Logged Out From All Devices");
    }

    public function logout(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $token = $request->header('authorization');
        $tokenArray = explode('|',$token);
        $tokenId = str_replace('Bearer ','',$tokenArray[0]);
        $user->tokens()->where('id',$tokenId)->delete();
        return $this->returnSuccessMessage("User Has Been Successfully Logged Out");
    }

    
}
