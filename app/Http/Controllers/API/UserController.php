<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validate;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        try{
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            // cek credential
            $credentials = request(['email','password']);
            if(!Auth::attempt($credentials)){
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ], 'Authentication Failed', 500);
            }

            // cek email password
            $user = User::where('email',$request->email)->first();
            if(!Hash::check($request->password, $user->password, [])){
                throw new \Exception('invalid credential');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Authenticated');
        }catch(Exception $error){
            return ResponseFormatter::error([
                'message' => 'Somethineg went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function getUser(Request $request)
    {
        return ResponseFormatter::success($request->user(), 'Data profile user berhasil diambil');
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();
        return ResponseFormatter::success(
            $token, 'Token revoked'
        );
    }

}
