<?php

namespace App\Http\Traits;

trait SafeResponse
{
    private function safeResponse($callbackFunction, $messages)
    {
        $safeResponse = [
            "success" => false,
            "message" => "Something goes wrong"
        ];

        $callBackResp = [];
        try {
            $callBackResp = call_user_func($callbackFunction);
            $safeResponse["success"] = true;
            $safeResponse["message"] = ($callBackResp && $callBackResp['type'] && $callBackResp['type'] == 422 ) ? "Validation Error" :   $messages['success'] ?? "Everything is OK!";
        } catch (\Throwable $e) {
            //We can use for wraiting code in Error database or somewhere
            $safeResponse["success"] = false;
            $safeResponse["message"] = $messages['error'] ?? "Something went's wrong";
        }
        return $callBackResp + $safeResponse;
    }
}