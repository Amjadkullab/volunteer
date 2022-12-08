<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {

        $validatore = Validator($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:3|max:30',
        ]);
        if (!$validatore->fails()) {
            $user = User::where('email', $request->get('email'))->first();
            if (Hash::check($request->get('password'), $user->password)) {
                $this->revokePreviousTokens($user->id);
                $token = $user->createToken('user-Api');
                $user->setAttribute('token', $token->accessToken);
                return response()->json([
                    'message' => 'logged in Successfuly', 'data' => $user
                ], Response::HTTP_OK);
            } else {
                return response()->json(['message' => 'Wrong Password'], Response::HTTP_OK);
            }
        } else {
            return response()->json([
                'message' => $validatore->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
    private function revokePreviousTokens($userId)
    {
        DB::table('oauth_access_tokens')
            ->where('user_id', $userId)
            ->update([
                'revoked'=>true
            ]);
    }
    public function logout()
    {
        $token = auth('api')->user()->token();
        $isRevoked = $token->revoke();
        return response()->json([
            'status'=> $isRevoked ,
            'message' => $isRevoked ? 'Logout Successfully' : 'Faild to Logout'
        ], $isRevoked ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
