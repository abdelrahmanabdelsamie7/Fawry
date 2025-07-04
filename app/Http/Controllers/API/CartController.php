<?php
namespace App\Http\Controllers\API;
use App\Models\Cart;
use App\traits\ResponseJsonTrait;
use App\Http\Requests\CartRequest;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    use ResponseJsonTrait;
    public function store(CartRequest $request)
    {
        $cart = Cart::firstOrCreate(['customer_id' => $request->validated()->customer_id]);
        return $this->sendSuccess('Cart created or already exists.', $cart);
    }
    public function show($customer_id)
    {
        $cart = Cart::with('items.product')->where('customer_id', $customer_id)->first();
        if (!$cart) return $this->sendError('Cart not found.', 404);
        return $this->sendSuccess('Cart retrieved successfully.', $cart);
    }
    public function destroy($customer_id)
    {
        $cart = Cart::where('customer_id', $customer_id)->first();
        if (!$cart) return $this->sendError('Cart not found.', 404);
        $cart->delete();
        return $this->sendSuccess('Cart deleted successfully.');
    }
}