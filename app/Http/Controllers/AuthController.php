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
use JWTAuth;

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
                    'password' => 'required|confirmed|min:4',
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

            return response()->json(
                [
                    'status' => true,
                    'message' => 'Logged In Successfully',
                    'token' => $user->createToken("Idea_token")->plainTextToken
                ], 200);

        }   
            catch (\Throwable $e) 
        {
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
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 400);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
    }
}
