<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Repositories\UserRepository;
use App\Domain\Entities\User;
use Illuminate\Support\Facades\Hash;

class EloquentUserRepository implements UserRepository
{
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function createUser(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }
}
