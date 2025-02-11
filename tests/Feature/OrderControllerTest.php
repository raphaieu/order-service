<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Domain\Entities\Order;
use App\Domain\Entities\User;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_order()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->postJson('/api/orders', [
            'total' => 200.00
        ])->assertStatus(201)
            ->assertJson([
                'user_id' => $user->id,
                'total' => 200.00,
                'status' => 'pending'
            ]);
    }

    public function test_unauthenticated_user_cannot_create_order()
    {
        $this->postJson('/api/orders', [
            'total' => 200.00
        ])->assertStatus(401);
    }
}
