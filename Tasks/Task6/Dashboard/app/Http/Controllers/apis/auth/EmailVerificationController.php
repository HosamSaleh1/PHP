<?php

namespace App\Http\Controllers\apis\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\traits\apiTrait;
use App\Mail\SendCode;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{
    use apiTrait;
    public function sendCode(Request $request)
    {
        $token = $request->header('authorization');
        $authenticatedUser = Auth::guard('sanctum')->user();
        $user = User::find($authenticatedUser->id);
        $user->code = rand(10000,99999);
        $user->save();
        // send code in mail
        Mail::to($user)->send(new SendCode($user));
        $user->token = $token;
        return $this->returnData(compact('user'),'Mail Sent Successfully');
        // return $this->test('code',rand(10000,99999),'Mail Sent Successfully',$request);
    }

    public function emailVerification(Request $request)
    {
        $token = $request->header('authorization');
        $authenticatedUser = Auth::guard('sanctum')->user();
        $user = User::find($authenticatedUser->id);
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();
        $user->token = $token;
        return $this->returnData(compact('user'),'User Has Been Verified Successfully');
        // return $this->test('email_verified_at',date('Y-m-d H:i:s'),'User Has Been Verified Successfully',$request);
    }

    // private function test($columnName,$columnValue,$message,$request){
    //     $token = $request->header('authorization');
    //     $authenticatedUser = Auth::guard('sanctum')->user();
    //     $user = User::find($authenticatedUser->id);
    //     $user->{"$columnName"} = $columnValue;
    //     $user->save();
    //     $user->token = $token;
    //     return $this->returnData(compact('user'),$message);
    // }
}
