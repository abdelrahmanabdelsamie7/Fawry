<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'is_expire' => 'boolean',
            'expire_at' => 'required_if:is_expire,true|nullable|date|after:today',
            'is_shippable' => 'boolean',
            'weight' => 'required_if:is_shippable,true|nullable|numeric|min:0',
        ];
    }
}
