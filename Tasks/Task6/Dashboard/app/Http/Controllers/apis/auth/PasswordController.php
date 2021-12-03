<?php

namespace App\Http\Controllers\apis\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SetNewPasswordRequest;
use App\Http\Requests\verifyEmailRequest;
use App\Http\traits\apiTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    use apiTrait;
    public function verifyEmail(verifyEmailRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        $token = 'Bearer ' . $user->createToken($request->email)->plainTextToken;
        $user->token = $token;
        return $this->returnData(compact('user'));
    }

    public function setNewPassword(SetNewPasswordRequest $request)
    {
        $token = $request->header('authorization');
        $authenticatedUser = Auth::guard('sanctum')->user();
        $user = User::find($authenticatedUser->id);
        $user->password = Hash::make( $request->password );
        $user->save();
        $user->token = $token;
        return $this->returnData(compact('user'),'Password Changed Successfully');
    }
}
