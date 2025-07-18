<?php
namespace App\Http\Controllers\API;
use App\Models\{Customer, Cart, Order, OrderItem};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Traits\ResponseJsonTrait;
class OrderController extends Controller
{
    use ResponseJsonTrait;
    public function checkout($customerId)
    {
        $customer = Customer::findOrFail($customerId);
        $cart = Cart::with('items.product')->where('customer_id', $customerId)->first();
        if (!$cart || $cart->items->isEmpty()) {
            return $this->sendError('Cart is empty.');
        }
        $subtotal = 0;
        $shippingItems = [];
        $shippingFees = 0;
        DB::beginTransaction();
        try {
            foreach ($cart->items as $item) {
                $product = $item->product;
                if ($product->is_expire && $product->expire_at < now()) {
                    return $this->sendError("Product '{$product->name}' is expired.");
                }
                if ($product->quantity < $item->quantity) {
                    return $this->sendError("Product '{$product->name}' is out of stock.");
                }
                $linePrice = $item->quantity * $product->price;
                $subtotal += $linePrice;
                if ($product->is_shippable) {
                    $shippingItems[] = [
                        'name' => $product->name,
                        'weight' => $product->weight * $item->quantity
                    ];
                    $shippingFees += 30;
                }
                $product->quantity -= $item->quantity;
                $product->save();
            }
            $total = $subtotal + $shippingFees;
            if ($customer->balance < $total) {
                return $this->sendError("Customer's balance is insufficient.");
            }
            $customer->balance -= $total;
            $customer->save();
            $order = Order::create([
                'customer_id' => $customer->id,
                'subtotal' => $subtotal,
                'shipping_fees' => $shippingFees,
                'total_paid' => $total,
            ]);
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price
                ]);
            }
            $cart->items()->delete();
            DB::commit();
            return $this->sendSuccess('Checkout completed successfully.', $order);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendError('Checkout failed: ' . $e->getMessage());
        }
    }
    public function showMyOrders($customerId)
    {
        $customer = Customer::findOrFail($customerId);
        $orders = Order::with(['items.product'])
            ->where('customer_id', $customer->id)
            ->latest()
            ->get();
        return $this->sendSuccess('Orders retrieved successfully.', $orders);
    }
}
