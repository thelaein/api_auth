<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){

    }
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $token = Auth::user()->createToken('user-auth');

            return response()->json([
                'message'=>'U login',
                'token'=> $token
            ]);
        }
        return response()->json([
            'message'=>'Login fail'
        ]);

    }

    public function logout(){
        Auth::user()->tokens()->delete();
        return response()->json(['message'=>'logout successful']);
    }
}
