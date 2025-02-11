<?php

namespace App\Domain\ValueObjects;

enum OrderStatus: string {
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';
    case CANCELED = 'canceled';
}
