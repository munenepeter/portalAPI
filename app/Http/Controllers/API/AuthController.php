<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {

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


    public function verifyLogin(Request $request, $token) {

        try {
            $tokenModel = \App\Models\LoginToken::whereToken(hash('sha256', $token))->firstOrFail();

            abort_unless($request->hasValidSignature() && $tokenModel->isValid(), 401);

            $tokenModel->consume();

            Auth::login($tokenModel->user);

            return response()->json(['message' => 'Login verification successful', 'user' => Auth::user()], 200);

        } catch (\Exception $e) {
       
            return response()->json(['error' => 'Login verification failed', 'message' => $e->getMessage()], 401);
        }
    }

    public function logout() {
        Auth::logout();
        return response()->noContent(200);
    }
}
