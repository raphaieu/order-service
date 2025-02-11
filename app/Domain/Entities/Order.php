<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\OrderStatus;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total', 'status'];

    public function setStatus(OrderStatus $status): void
    {
        $this->status = $status->value;
    }
}
