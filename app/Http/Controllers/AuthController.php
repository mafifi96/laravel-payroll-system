<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthController extends Controller
{
    public function login(Request $request)
    {


            $creds = $request->validate([
                'email' => 'email', 'password' => 'required'
            ]);

            if (Auth::attempt($creds)) {

                $token = auth()->user()->createToken('token')->plainTextToken;

                $data = ['token' => $token];
                
                return simpleSuccessResponse($data,'Login Successfully');

            }else{

                return failMessageResponse("Email or Password is wrong.");
            }


    }

    public function register(Request $request)
    {
    }

    public function logout(Request $request
    )
    {

        auth()->user()->tokens()->delete();


        return response()->json(['message' => 'logged out']);
    }
}
