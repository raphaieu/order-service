<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\User;

interface UserRepository
{
    public function findByEmail(string $email): ?User;
    public function createUser(array $data): User;
}
