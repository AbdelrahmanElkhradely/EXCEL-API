<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckAdminToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user=null;
        try {
            $user=JWTAuth::parseToken()->authenticate();
        }catch (\Exception $e){
            return response()->json(['message'=> 'error']);
        }
        if(! $user){
            return response()->json(['message'=> 'error']);

        }
        return $next($request);
    }
}
