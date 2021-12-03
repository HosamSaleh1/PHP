<?php

namespace App\Http\Controllers\apis\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\traits\apiTrait;

class RegisterController extends Controller
{

    use apiTrait;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        $user->token = 'Bearer '.$user->createToken($request->device_name)->plainTextToken;
        return $this->returnData(compact('user'),'register Completed');
    }
}
