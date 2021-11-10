<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        try {

            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);
            $user->token = '';

            $user->save();

            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            dd($e);
            return response()->json(['message' => 'User Registration Failed!'], 409);

        }
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]); 

        try{
            $user = User::where('email', $request->email)->firstOrFail();
        }catch(\Exception $e){
            return response()->json(['message' => 'User not found'],401);
        }

        if($user->token == 'Revoked'){
            return response()->json(['message' => 'Revoked'],401);
        }

        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $data = $this->respondWithToken($token);

        $user->token = $data->original['token'];
        $user->save();
        return response()->json(['token' => $data->original['token'],'type' => 'bearer'], 200);
    }
}