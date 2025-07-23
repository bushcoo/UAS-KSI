<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'order_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('orders', 'order_number')->ignore($this->order)
            ],
            'total_amount' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'string', Rule::in(['pending', 'processing', 'completed', 'cancelled'])],
            'shipping_address' => ['required', 'string', 'max:65535'],
            'billing_address' => ['required', 'string', 'max:65535'],
            'payment_method' => ['nullable', 'string', Rule::in(['bank_transfer', 'credit_card', 'e_wallet'])],
            'payment_status' => ['required', 'string', Rule::in(['pending', 'paid', 'failed'])],
            'paid_at' => ['nullable', 'date'],
            
            // Validasi untuk order items
            'items' => ['sometimes', 'array'],
            'items.*.product_id' => ['required', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.price' => ['required', 'numeric', 'min:0'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->order_number) {
            $this->merge([
                'order_number' => 'ORD-' . strtoupper(uniqid()),
            ]);
        }
    }
}
