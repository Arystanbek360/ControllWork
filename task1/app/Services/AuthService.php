<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthService
{
    public function login(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw new Exception('Не верный логин или пароль', Response::HTTP_BAD_REQUEST);
        }

        return [
            'user' => UserResource::make($user),
            'token' => $user->createToken($data['email'])->plainTextToken
        ];
    }

    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return ['user' => UserResource::make($user)];
    }
}