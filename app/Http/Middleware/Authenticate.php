<?php

namespace App\Http\Middleware;

use Closure;
use \Firebase\JWT\JWT;
use Auth;
class Authenticate {

    public function handle($request, Closure $next, $role) {
        /**
         * Decode JWT token
         * I use env('APP_KEY') as Salt or Secret-key for my hashing algorithm
         */
        $user_info = JWT::decode($request->token, env('APP_KEY'), ['HS256']);
      
        /**
         * If JWT token match with sepecific $role the request will continue
         */
        if (in_array($role, $user_info->roles)){
            /**
             * Authenticate user manualy
             */
            Auth::loginUsingId($user_info->user_id);
            
            return $next($request);
        }
        else{
             return response()->json(['state' => 'failed', 'messages' => 'You don\'t have permission']);
        }
    }

}
