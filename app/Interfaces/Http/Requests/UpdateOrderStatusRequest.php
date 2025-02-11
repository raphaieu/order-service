<?php

namespace App\Interfaces\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Permite que qualquer usuário autenticado altere o status do pedido
    }

    public function rules(): array
    {
        return [
            'status' => 'required|string|in:pending,processing,completed,canceled',
        ];
    }
}
