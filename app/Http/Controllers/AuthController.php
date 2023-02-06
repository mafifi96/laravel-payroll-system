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

                return  $this->sendResponse($data, 'logged in successfully');
            }else{

                return $this->sendError('Email or Password is wrong.' , code: 401);
            }


    }

    public function register(Request $request)
    {
    }

    public function logout()
    {
        // Revoke all tokens...
        auth()->user()->tokens()->delete();

        // Revoke the token that was used to authenticate the current request...
        //$request->user()->currentAccessToken()->delete();

        // Revoke a specific token...
       // $user->tokens()->where('id', $tokenId)->delete();

        return response()->json(['message' => 'logged out']);
    }
}
