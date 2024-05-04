<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Client;

use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $user = User::create([
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'type' => "client",
            'status' => '0'
        ]);

        $userId = $user->id;

        Client::create([
            'user_id' => $userId,
            'first_name' => $request->input('first_name'),
            'birth_date' => $request->input('birth_date'),
            'address' => $request->input('address'),
            'last_name' => $request->input('last_name'),
            'telephone' => $request->input('telephone'),

        ]);

        return response()->json(['message' => 'User registered successfully', 'user' => $user]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response([
                'message' => 'Invalid credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt', $token, 30 * 24 * 60);

        if ($user->type == 'host') {
            $username = $user->host->first_name . ' ' . $user->host->last_name;
        } else {
            $username = $user->client->first_name . ' ' . $user->client->last_name;
        }
        $userType = $user->type;
        $userImage = $user->image;

        return response([
            'message' => 'success',
            'token' => $token,
            'username' => $username,
            'userType' => $userType,
            'userImage' => $userImage,
            'userType' => $user->type
        ])->withCookie($cookie);
    }


    public function logout(Request $request)
    {
        // auth()->user()->tokens()->delete();
        Cookie::forget('jwt');

        return response()->json([
            'message' => 'Success'
        ], 200);
    }
}
