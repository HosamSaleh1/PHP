<?php

namespace App\Http\traits;

trait apiTrait {
    public function returnSuccessMessage(string $message="",int $code=200)
    {
        return response()->json([
            'message'=>$message,
            'errors'=>(object)[],
            'data'=>(object)[]
        ],$code);
    }
    public function returnErrorMessage(string $message="",int $code=422)
    {
        return response()->json([
            'message'=>$message,
            'errors'=>(object)[],
            'data'=>(object)[]
        ],$code);
    }
    public function returnData(Array $data, string $message="",int $code=200)
    {
        return response()->json([
            'message'=>$message,
            'errors'=>(object)[],
            'data'=>$data
        ],$code);
    }
}