<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterUsersRequest;
use App\Http\Requests\LoginUsersRequest;

class AuthController extends Controller
{

   public function register(RegisterUsersRequest $request)  {
    $validated = $request->validated();
    $user = new User();
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->password = Hash::make($validated['password']); // Hash password
    $user->save(); 

    $token = JWTAuth::fromUser($user);
    // $refreshToken = JWTAuth::refresh($token);
    return response()->json([
      'response'=> [
      'status'=>true,
      'message'=>'Successfully Register Account',
      'data'=> $user,
      'access_token' => $token,
      'token_type' => 'bearer',
      'expires_in' => auth('api')->factory()->getTTL() * 60, 
    ],
       ],201
    );

   }


   public function login(LoginUsersRequest $request)
   {
       $credentials = $request->only('email', 'password');

       if (!$token = JWTAuth::attempt($credentials)) {
        return response()->json([
                'response'=> [
                    'status'=>false,
                    'message'=>'Unvalid Authorization',
                    'data'=>$credentials,
                ],
            ],401
        );
    }

    $user = auth('api')->user();

    // Jika login berhasil, kembalikan token dan data user
    return response()->json([
        'response'=> [
        'message' => 'Login successful',
        'user' => $user,
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth('api')->factory()->getTTL() * 60,
        ],
    ],201
    );
   }

   public function logout(Request $request)
   {
       try {
           JWTAuth::invalidate(JWTAuth::getToken());

           return response()->json([
              'response' => [
              'status'=>true,
              'message' => 'Successfully logged out',
           ]
        ],200
        );
       } catch (\Exception $e) {
           return response()->json([
               'message' => 'Failed to logout, please try again'
           ], 500);
       }
   }


}
 

