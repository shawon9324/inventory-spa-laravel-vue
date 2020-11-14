<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;

class AuthController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['login','signup']]);
    }

    /* Get a JWT token via given credentials.*/
    public function login(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required ',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['errors' => 'Email and Password is incorrect!']);
    }

    /* Get the authenticated User */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /* Log the user out (Invalidate the token)*/
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /*Refresh a token*/
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    public function signup(Request $request){
        $data = $request->all();
        $validateData = $request->validate([
            'name' => 'required | regex:/^[\pL\s\-]+$/u ',
            'email' => 'required | unique:users',
            'password' => 'min:5|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'same:password'
        ]);
        $users = new User;
        $users->name = $data['name'];
        $users->email = $data['email'];
        $users->password = bcrypt($data['password']);
        $users->save();
        return $this->login($request);
    }

    
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60,
            'name' => auth()->user()->name,
            'user_id' => auth()->user()->id,
            'email' => auth()->user()->email,
        ]);
    }

    public function guard()
    {
        return Auth::guard();
    }
    
}
