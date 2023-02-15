<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showFormRegister()
    {
        return Inertia::render('Register');
    }

    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4',
        ]);

        if($validation->fails()){
            $response = [
                'status' => 400,
                'success' => false,
                'message' => $validation->errors(),
            ];
            return response()->json($response, 400);
        }

        $user = User::create ([
            'name' => $request-> name,
            'email' => $request-> email, 
            'password' => Hash::make($request-> password),
        ]);

        $response = [
            'status' => 201,
            'success' => true,
            'message' => 'Successfully!',
            'data' => [
                'token' => $user->createToken('MyIdea')->plainTextToken,
                'name' => $user->name,
                'email'=>$user->email,
            ]
        ];
            return response()->json($response,200);
    }

    public function showFormLogin()
    {
        return Inertia::render('Login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->json()->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->json()->get('name'),
            'email' => $request->json()->get('email'),
            'password' => Hash::make($request->json()->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'), 201);
    }

    public function showProfile()
    {
        try{
            if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['user_not_found'], 400);
            }
        }catch (TokenExpiredException $e){
            return response()->json(['token_expired'], $e->getStatusCode());
        }catch (TokenInvalidException $e){
            return response()->json(['token_invalid'], $e->getStatusCode());
        }catch (JWTException $e){
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        return response()->json(compact('user'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('show-form-login');
    }
}