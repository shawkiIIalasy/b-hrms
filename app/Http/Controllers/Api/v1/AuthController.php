<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
    /**
     * Login
     */
    public function login(LoginRequest $request)
    {
        if (! Auth::attempt($request->only(['email', 'password']))) {
            return $this->error('Credentials not match', 401);
        }

        $user = User::findOrFail(auth()->user()->id);

        info($user->hasRole('admin'));
        return $this->success(['access_token' => $user->createToken('access_token')->plainTextToken], 'Authenticated successfully.');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): \Illuminate\Http\JsonResponse
    {
        auth()->user()->tokens()->delete();

        return $this->success([], 'Tokens revoked.');
    }

    public function authenticated()
    {
        return $this->success([], 'Authenticated successfully.');
    }
}
