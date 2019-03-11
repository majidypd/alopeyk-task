<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use \App\User;
use \Firebase\JWT\JWT;
use Hash;

class UserController extends Controller {

    /**
     * Authenticate a user 
     * @param Request $request
     * @return type
     */
    public function authenticate(Request $request) {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            /**
             * Get all roles  by user and store in JWT token (Claim part)
             */
            $roles = array_map(function($val) {return $val['title'];}, Auth::user()->roles->toArray());
            
            /**
             * I use env('APP_KEY') as `Salt` for my hash method
             */
            $secretkey = env('APP_KEY');

            $payload = ["user_id" => Auth::id(), "exp" => time() + 1000, "roles" => $roles];
            try {
                $jwt = JWT::encode($payload, $secretkey);
                return response()->json(['state' => 'success', 'token' => $jwt]);
            } catch (UnexpectedValueException $e) {
                return response()->json(['state' => 'failed', 'messages' => $e->getMessage()]);
            }
        } else {
            return response()->json(['state' => 'failed', 'messages' => 'access denied!']);
        }
    }

    /**
     * Create a new User (admin,seller or customer)
     * @param Request $request
     * @param type $roleId
     * @return type
     */
    public function store(Request $request, $roleId) {
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required|email',
                    'password' => 'required',
                    'lat' => 'required|numeric',
                    'lng' => 'required|numeric',
                    'address' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['state' => 'failed', 'messages' => $validator->errors()]);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->lat = $request->lat;
        $user->lng = $request->lng;
        $user->address = $request->address;
        if ($user->save()) {
            /**
             * Attach role to inserted user
             */
            $user->roles()->attach($roleId);
            return response()->json(['state' => 'success', 'messages' => 'You did it !']);
        } else {
            return response()->json(['state' => 'failed', 'messages' => 'something goes wrong!']);
        }
    }

}
