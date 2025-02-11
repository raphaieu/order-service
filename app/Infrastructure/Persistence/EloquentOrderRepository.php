<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Repositories\OrderRepository;
use App\Domain\Entities\Order;

class EloquentOrderRepository implements OrderRepository
{
    public function create(array $data): Order
    {
        return Order::create([
            'user_id' => $data['user_id'],
            'total' => $data['total'],
            'status' => $data['status'] ?? 'pending'
        ]);
    }

    public function findById(int $id): ?Order
    {
        return Order::find($id);
    }

    public function findByUserId(int $userId): array
    {
        return Order::where('user_id', $userId)->get()->toArray();
    }

    public function findAll(): array
    {
        return Order::all()->toArray();
    }

    public function update(Order $order): Order
    {
        $order->save();
        return $order;
    }

    public function delete(int $id): void
    {
        Order::destroy($id);
    }
}
