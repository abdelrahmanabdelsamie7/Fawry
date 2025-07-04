<?php
namespace App\Models;
use App\Models\{Order, Product};
use App\traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class OrderItem extends Model
{
    use HasFactory, UsesUuid;
    protected $table = 'order_items';
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price',];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
