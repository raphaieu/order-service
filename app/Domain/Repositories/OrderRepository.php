<?php
namespace App\Domain\Repositories;

use App\Domain\Entities\Order;

interface OrderRepository
{
    public function create(array $data): Order;
    public function findById(int $id): ?Order;
    public function findByUserId(int $userId): array;
    public function findAll(): array;
    public function update(Order $order): Order;
    public function delete(int $id): void;
}
