<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginRequest;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function login(LoginRequest $request): UserResource
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Не точна лозинка или е-пошта.'],
            ]);
        }
        $token = $user->createToken($request->device_name)->plainTextToken;

        return UserResource::make($user)
            ->additional(['token' => $token]);
    }

    public function logout(): JsonResponse
    {
        $user = auth()->user();

        if ($user) {
            $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        }

        return response()->json(['message' => 'Успешно се одјавивте!']);
    }
}
