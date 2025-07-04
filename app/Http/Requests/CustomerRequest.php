<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class CustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $customerId = $this->route('id') ?? $this->route('customer');
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:customers,email,'.$customerId,
            'balance' => 'required|numeric|min:0',
        ];
    }
}