<?php

namespace App\Utils;

use Illuminate\Http\Response as LaravelResponse;

class Response
{
    /**
     * Returns a Succesful Message Response
     * 
     * @param String $message.
     * 
     * @return \Illuminate\Http\Response
     * 
     */
    static function success(string $message = "Succesfully") : LaravelResponse
    {
        return response([ 
            'success' => true, 
            'message' => $message
        ], 200);
    }

    /**
     * Returns a Error Message Response
     * 
     * @param String $message.
     * 
     * @return \Illuminate\Http\Response
     * 
     */
    static function error(string $message = "Error") : LaravelResponse
    {
        return response([ 
            'success' => false, 
            'message' => $message
        ], 500);
    }
}