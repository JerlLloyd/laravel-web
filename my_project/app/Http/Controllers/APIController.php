<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class APIController extends Controller
{
    public function getUser()
    {
        $items=User::all();
        
        return response()->json($items);
    }
    
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' =>'required|string|min:6'
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors()->first()
            ], 401);
        }

        $credentials = request(['email', 'password']);
        if(!auth()->attempt($credentials)){
            return response()->json([
                'message' => "Unauthorized, Check your login credecentials"
            ], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 401);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;

        return response()->json([
            'message' => "User successfully registerd",
            'token' => $token,
            'user' => $user
        ]);

    }

    public function accounts()
    {
        return response()->json(auth()->user());
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => "User successfully logged out "]);
    }

}