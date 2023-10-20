<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->only('username', 'password'))) {
            return response()->json([
                'status' => 'error',
                'message' => 'Usuario y/o clave incorrecta.',
            ], 403);
        }

        $user = $request->user();
        $token = $user->createToken('AuthTokenLottoplay321654878237');

        return response()->json([
            'status' => 'success',
            'message' => "Bienvenid@, " . $user->name,
            'user' => $user,
            'userAbilities'=> [
                'action' => 'manage',
                'subject' => 'all',
            ],
            'authorisation' => [
                'token' => $token->accessToken,
                'expire' => $token->token->expires_at,
            ]
        ]);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'validate',
                'message' => $validator->errors(),
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'type' => $request->session == null ? 4 : $request->type,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'Usuario creado con éxito.',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->user()->token()->revoke();

        return response()->json([
            'status' => 'success',
            'message' => 'Se ha cerrado la sesión con éxito',
        ]);
    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
        ]);
    }


    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(Request $request): JsonResponse
    {
        $request->user()->token()->revoke();
        $newToken = $request->user()->createToken('AuthTokenLottoplay321654878237');

        return response()->json([
            'token' => $newToken->accessToken,
            'expire' => $newToken->token->expires_at,
        ], 200);
    }
}
