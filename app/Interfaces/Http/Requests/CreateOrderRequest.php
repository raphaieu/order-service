<?php

namespace App\Interfaces\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Permite que qualquer usuário autenticado faça pedidos
    }

    public function rules(): array
    {
        return [
            'total' => 'required|numeric|min:1',
        ];
    }
}
