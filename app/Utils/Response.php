<?php

namespace App\Utils;

use Illuminate\Http\Response as LaravelResponse;

class Response
{
    static function success(string $message = "Succesfully") : LaravelResponse
    {
        return response([ 
            'success' => true, 
            'message' => $message
        ], 200);
    }

    static function error(string $message = "Error") : LaravelResponse
    {
        return response([ 
            'success' => false, 
            'message' => $message
        ], 500);
    }
}