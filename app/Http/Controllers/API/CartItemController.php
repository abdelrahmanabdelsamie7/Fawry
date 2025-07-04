<?php
namespace App\Http\Controllers\API;
use App\Models\{Cart, CartItem, Product};
use App\Http\Controllers\Controller;
use App\Http\Requests\CartItemRequest;
use App\Traits\ResponseJsonTrait;
class CartItemController extends Controller
{
    use ResponseJsonTrait;
    public function store(CartItemRequest $request)
    {
        $data = $request->validated();
        $cart = Cart::firstOrCreate(['customer_id' => $data['customer_id']]);
        $product = Product::findOrFail($data['product_id']);
        if ($product->quantity < $data['quantity']) {
            return $this->sendError('Insufficient product quantity.');
        }
        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();
        if ($item) {
            $item->quantity += $data['quantity'];
            $item->save();
        } else {
            $item = CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $data['quantity']
            ]);
        }
        return $this->sendSuccess('Item added to cart.', $item);
    }
    public function update(CartItemRequest $request, $id)
    {
        $data = $request->validated();
        $item = CartItem::findOrFail($id);
        $product = Product::findOrFail($data['product_id']);
        if ($product->quantity < $data['quantity']) {
            return $this->sendError('Insufficient product quantity.');
        }
        $item->update([
            'product_id' => $data['product_id'],
            'quantity' => $data['quantity'],
        ]);
        return $this->sendSuccess('Cart item updated successfully.', $item);
    }
    public function destroy($id)
    {
        $item = CartItem::findOrFail($id);
        $item->delete();
        return $this->sendSuccess('Cart item deleted.');
    }
    public function clear($customer_id)
    {
        $cart = Cart::where('customer_id', $customer_id)->first();
        if (!$cart)
            return $this->sendError('Cart not found.', 404);
        $cart->items()->delete();
        return $this->sendSuccess('Cart cleared.');
    }
}
