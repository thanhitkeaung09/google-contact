<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required|confirmed|min:8'
        ]);
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        if(Auth::attempt($request->only(['email','password']))){

            $token = Auth::user()->createToken('phone')->plainTextToken;
            return $token;
        }
        return response()->json('User is created',200);
    }

    public function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required|confirmed|min:8'
        ]);
        if(Auth::attempt($request->only(['email','password']))){
            $token = Auth::user()->createToken("phone")->plainTextToken;
            return $token;
        }
        return response()->json(['message'=>'User not found'],404);
    }

    public function logout(){
        Auth::user()->currentAccessToken()->delete();
        return response()->json(['message'=>'Logout is successful'],404);
    }

    public function logoutAll(){
//        return "logout all devices";
        Auth::user()->tokens()->delete();
        return response()->json(['message'=>'Logout all devices'],404);
    }


}
