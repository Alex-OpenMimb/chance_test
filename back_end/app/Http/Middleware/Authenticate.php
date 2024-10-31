<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request)
    {
        //return $request->expectsJson() ? null : route('login');
        if (!$request->expectsJson()) {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'Unauthorized: Token has expired or is invalid.',
            ], 401));
        }
    }
}
