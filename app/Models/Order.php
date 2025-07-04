<?php
namespace App\Models;
use App\Models\{Customer, OrderItem};
use App\traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Order extends Model
{
    use HasFactory, UsesUuid;
    protected $table = 'orders';
    protected $fillable = ['customer_id', 'subtotal', 'shipping_fees', 'total_paid',];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
