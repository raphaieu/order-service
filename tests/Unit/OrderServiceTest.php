<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Application\Services\OrderService;
use App\Domain\Repositories\OrderRepository;
use App\Domain\Entities\Order;
use Mockery;

class OrderServiceTest extends TestCase
{
    public function test_create_order()
    {
        $repository = Mockery::mock(OrderRepository::class);
        $repository->shouldReceive('create')
            ->once()
            ->andReturn(new Order([
                'id' => 1,
                'user_id' => 1,
                'total' => 150.75,
                'status' => 'pending'
            ]));

        $service = new OrderService($repository);
        $order = $service->createOrder(1, 150.75);

        $this->assertEquals(1, $order->user_id);
        $this->assertEquals(150.75, $order->total);
        $this->assertEquals('pending', $order->status);
    }
}
