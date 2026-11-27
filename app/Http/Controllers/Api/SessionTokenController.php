<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SessionTokenController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'courriel' => ['required', 'email'],
            'motdepasse' => ['required', 'string'],
        ]);

        $user = User::query()
            ->where('courriel', $credentials['courriel'])
            ->first();

        if (! $user || ! Hash::check($credentials['motdepasse'], $user->getAuthPassword())) {
            throw ValidationException::withMessages([
                'courriel' => ['Les identifiants fournis sont invalides.'],
            ]);
        }

        $token = $user->createToken('api')->plainTextToken;

        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'idUtilisateurs' => $user->idUtilisateurs,
                'nom' => $user->nom,
                'courriel' => $user->courriel,
                'role' => $user->role,
            ],
        ], 201);
    }

    public function destroy(Request $request): JsonResponse
    {
        $request->user()?->currentAccessToken()?->delete();

        return response()->json([
            'message' => 'Jeton révoqué.',
        ]);
    }
}