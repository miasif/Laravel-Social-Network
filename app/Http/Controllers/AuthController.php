<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\DB;
Use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // public function Login(Request $request){

    //     try{
    //         if(Auth::attempt($request->only('email','password'))){
    //             $user = Auth::user();
    //             $token = Auth::user()->createToken('app')->accessToken;
    //             return response()->json([
    //                 'message' => 'Login Successful',
    //                 'token'=>$token,
    //                 'user'=>$user
    //                 ],200);
    //         }
    //     }catch(\Exception $e){
    //         return response()->json(['error' => $e->getMessage()], 401);
    //     }
    //     return response()->json(['error' => 'Unauthorised'], 401);
    // }

    public function Login(Request $request){
        try{
            if(Auth::attempt($request->only('email','password'))){
                $user = Auth::user();
                // $accessToken = $user->createToken('app')->accessToken;
                $token = Auth::user()->createToken('app')->accessToken;
                    return response([
                        'message'=>"Login Successful",
                        'token'=>$token,
                        'user'=>$user
                    ],200);    
            }
        }catch(\Exception $exception){
            return response([
                'message'=>$exception->getMessage()
            ],400);
        }
        return response([
            'message'=>"Login Failed"
        ],401);

    }
    public function Register(RegisterRequest $request){
        try{
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $token = $user->createToken('app')->accessToken;
            return response()->json([
                'message' => 'Registration Successful',
                'token'=>$token,    
                'user'=>$user
                ],200);   
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 401);
        }

    }
}
