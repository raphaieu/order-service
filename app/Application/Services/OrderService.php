<?php

namespace App\Application\Services;

use App\Domain\Repositories\OrderRepository;
use App\Domain\Entities\Order;

class OrderService
{
    private OrderRepository $repository;
    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }
    public function createOrder(int $userId, float $total): Order
    {
        return $this->repository->create([
            'user_id' => $userId,
            'total' => $total,
            'status' => 'pending'
        ]);
    }
    public function getOrders(): array
    {
        return $this->repository->findAll();
    }
    public function updateOrderStatus(int $orderId, string $status): ?Order
    {
        $order = $this->repository->findById($orderId);

        if (!$order) {
            return null;
        }

        $order->status = $status;
        return $this->repository->update($order);
    }
    public function getOrdersByUser(int $userId): array
    {
        return $this->repository->findByUserId($userId);
    }
}
