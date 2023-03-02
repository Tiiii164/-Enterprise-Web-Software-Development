<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthController extends Controller
{
    public function showFormSignUp()
    {
        return Inertia::render('SignUp');
    }

    public function signup(Request $request)
    {
        try {
            $validation = Validator::make(
                $request->all(),
                [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users,email',
                    'password' => 'required|confirmed|min:3',
                    'department_id'=> 'required',
                ]
            );

            if ($validation->fails()) {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'validation error',
                        'errors' => $validation->errors(),
                    ],
                    401
                );
            }

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->department_id = $request->department_id;
            $user->save();
            $user->roles()->attach(Role::where('name', 'Staff')->first());

            return response()->json([
                'status' => true,
                'message' => 'Sign Up Successfully',
                'token' => $user->createToken("Idea_token")->plainTextToken
            ], 200);
            return response()->json($response, 200);
        } catch (\Throwable $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $e->getMessage()
                ],
                500
            );
        }
    }

    public function showFormSignIn()
    {
        return Inertia::render('SignIn');
    }

    public function signin(Request $request)
    {
        try {
            $validation = Validator::make(
                $request->all(),
                [
                    'email' => 'required|string|max:255',
                    'password' => 'required',
                ]
            );

            if ($validation->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validation->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Email & Password does not exist.',
                    ],
                    401
                );
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'Logged In Successfully',
                'token' => $user->createToken("Idea_token")->plainTextToken
            ], 200);
        } catch (\Throwable $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $e->getMessage()
                ],
                500
            );
        }
    }

    public function logout()
    {
        $accessToken = auth()->user()->token();
        $refreshToken = DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);
        $accessToken->revoke();
        return response()->json(['status' => 200]);
    }

    public function showProfile()
    {
        return Inertia::render('ShowProfile');
    }
}