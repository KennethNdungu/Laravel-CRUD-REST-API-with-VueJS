<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;
class AuthController extends Controller
{
    public function register(Request $request){
        $validData=$request->validate([
            'name'=>'required|max:50',
            'email'=>'email|required|unique:users',
            'password'=>'required|confirmed'
        ]);
        $validData['password']=Hash::make($request->password);

        $user=User::create($validData);

        $accessToken=$user->createToken('authToken')->accessToken;

        return response(['user'=>$user,'access_token'=>$accessToken]);
    }

    public function login(Request $request){
        $loginData=$request->validate([
            'email'=>'email|required',
            'password'=>'required'
        ]);

        if(!auth()->attempt($loginData)){
            return response(['message'=>'Invalid credentials!']);
        }

        $accessToken=auth()->user()->createToken('authToken')->accessToken;
        return response(['user'=>auth()->user(),'access_token'=>$accessToken]);


    }
}
