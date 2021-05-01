<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'access_level' => 'required',
        ]);

        $user = User::Create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'access_level' => $request->access_level
        ]);

        $token = $user->createToken('nikotoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];
        return response($response, 201);
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);


        if(Auth::attempt($request->only('email','password'))){

            $auth = Auth::user();
            $token = $auth->createToken('nikotoken')->plainTextToken;
            $response = [
                'user' => $auth,
                'token' => $token,
            ];
            return response($response, 201);

        }else{
            $response = [
                'message' => "Incorrect email or password!"
            ];
            return response($response, 422);
        }



    }
}
