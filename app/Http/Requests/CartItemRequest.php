<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class CartItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'customer_id' => 'required|uuid|exists:customers,id',
            'product_id' => 'required|uuid|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ];
    }
}
