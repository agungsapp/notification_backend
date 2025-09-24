<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        Log::info([
            "message" => "data dari flutter",
            "data" => $request->all()
        ]);
        // return response()->json($request->all());
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            Log::info("message");
            return response()->json([
                'status'  => false,
                'message' => 'Email atau password salah',
            ], 401);
        }


        if ($user->role !== 'employee') {
            return response()->json([
                'success' => false,
                'message' => 'Selain PIC dan Tim tidak di ijinkan login'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        Log::info([
            'status' => true,
            'message' => 'Login berhasil',
            'data' => [
                'user'  => $user,
                'token' => $token,
            ]
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Login berhasil',
            'data' => [
                'user'  => $user,
                'token' => $token,
            ]
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Logout berhasil'
        ]);
    }
}
