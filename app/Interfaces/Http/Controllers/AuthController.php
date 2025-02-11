<?php

namespace App\Interfaces\Http\Controllers;

use App\Application\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Domain\Entities\User;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $token = $this->authService->login($request->email, $request->password);

        return response()->json(['token' => $token]);
    }

    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout($request->user());

        return response()->json(['message' => 'Logout realizado com sucesso']);
    }

    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $user = $this->authService->register($request->all());

        return response()->json(['user' => $user, 'message' => 'Usuário criado com sucesso'], 201);
    }
}
