<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AccessTokensController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:3|max:30',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 401);
        }
        $cradentials = request(['email', 'password']);
        if (!auth()->attempt($cradentials)) {
            return response()->json([
                'message' => 'check your login'
            ], 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => $user
        ], 401);
    }

    public function register(Request $request)
    {
        $validatore = Validator($request->all(), [
            'name' => 'required|string|min:3|max:30',
            'email' => 'required|email|max:100|unique:users,email,',
            'password' => 'required|string|min:3|max:30|confirmed',
        ]);
        if ($validatore->fails()) {
            return response()->json([
                'message' => $validatore->errors()->first()
            ], 401);
        }

        $user = User::create(array_merge(
            $validatore->validate(),
            ['password' => bcrypt($request->password),]
        ));
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;
        return response()->json([
            'message' => 'User successfully register',
            'token' => $token,
            'user' => $user
        ]);
    }
    public function profile()
    {
        return response()->json(auth()->user());
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => "User successfully logout"]);
    }
}
