<?php
namespace App\Models;
use App\Models\{Product,Cart};
use App\traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory, UsesUuid;
    protected $table = 'cart_items';
    protected $fillable = ['cart_id', 'product_id', 'quantity'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
