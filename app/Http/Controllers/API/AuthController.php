<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {

    public function __construct() {
        $this->middleware('auth:api');
    }

    public function login(Request $request) {

        try {
            $data = $request->validate([
                'email' => ['required', 'email', 'exists:users,email'],
            ]);

            $user = User::whereEmail($data['email'])->first();

            if (!$user) {
                response()->json(['error' => 'Login link sending failed', 'message' => 'User not found'], 400);
            }


            $user->sendLoginLink();

            return response()->json(['message' => 'Login link sent successfully'], 200);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Login link sending failed', 'message' => $e->getMessage()], 400);
        }
    }


    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email
        ]);

        $token = Auth::login($user);

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }


    public function verifyLogin(Request $request, $token) {

        try {
            $tokenModel = \App\Models\LoginToken::whereToken(hash('sha256', $token))->firstOrFail();

            abort_unless($request->hasValidSignature() && $tokenModel->isValid(), 401);

            $tokenModel->consume();

            $token = Auth::login($tokenModel->user);

            if (!$token) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized',
                ], 401);
            }

            return response()->json([
                'status' => 'success',
                'user' => Auth::user(),
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Login verification failed', 'message' => $e->getMessage()], 401);
        }
    }

    public function logout() {
        Auth::logout();
        return response()->noContent(200);
    }

    public function refresh() {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
