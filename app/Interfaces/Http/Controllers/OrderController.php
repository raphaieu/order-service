<?php

namespace App\Interfaces\Http\Controllers;

use App\Application\Services\OrderService;
use App\Interfaces\Http\Requests\CreateOrderRequest;
use App\Interfaces\Http\Requests\UpdateOrderStatusRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
class OrderController extends Controller
{
    private OrderService $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function store(CreateOrderRequest $request): JsonResponse
    {
        $order = $this->service->createOrder(auth()->id(), $request->total);
        return response()->json($order, 201);
    }
    public function index(Request $request): JsonResponse
    {
        $orders = $this->service->getOrdersByUser(auth()->id());
        return response()->json($orders);
    }
    public function updateStatus(UpdateOrderStatusRequest $request, int $id): JsonResponse
    {
        $order = $this->service->updateOrderStatus($id, $request->status);

        if (!$order) {
            return response()->json(['message' => 'Pedido não encontrado.'], 404);
        }

        return response()->json($order);
    }
}
