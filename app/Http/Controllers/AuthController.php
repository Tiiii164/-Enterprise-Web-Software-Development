<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;
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
    public function showFormRegister()
    {
        return Inertia::render('Register');
    }
    public function register(Request $request)
    {
        try {
            $validation = Validator::make(
                $request->all(),
                [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users,email',
                    'password' => 'required|confirmed',
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
            $user->role_id = '1';
            $user->department_id = '1';
            $user->save();

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
    public function showFormLogin()
    {
        return Inertia::render('Login');
    }
    public function login(Request $request)
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

    public function store(Request $request)
    {
        $data = $request->input('user');
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt('password');
        $user->save();
        return response('success');
    }

    public function Profile()
    {
        try {
            if (!$token = JWTAuth::parseToken()) {
                return response()->json(['error' => 'Token not provided.'], 401);
            }
            $user = $token->authenticate();
            if (!$user) {
                return response()->json(['error' => 'User not found.'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'Token expired.'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'Token invalid.'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token absent.'], 401);
        }
        return response()->json(compact('user'));
    }

    public function updateProfile(Request $request)
    {
        try {
            if (!$token = JWTAuth::parseToken()) {
                return response()->json(['error' => 'Token not provided.'], 401);
            }
            $user = $token->authenticate();
            if (!$user) {
                return response()->json(['error' => 'User not found.'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'Token expired.'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'Token invalid.'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token absent.'], 401);
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
        return response()->json(compact('user'));
    }
}
