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
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|exists:customers,email',
            'balance' => 'required|numeric|min:0',
        ];
    }
}
