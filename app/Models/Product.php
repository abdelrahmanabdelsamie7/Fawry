<?php
namespace App\Models;
use App\Models\{CartItem, OrderItem};
use App\traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Product extends Model
{
    use HasFactory, UsesUuid;
    protected $table = 'products';
    protected $fillable = ['name', 'price', 'quantity', 'is_expire', 'expire_at', 'is_shippable', 'weight'];
    protected $casts = [
        'is_expire' => 'boolean',
        'is_shippable' => 'boolean',
        'expire_at' => 'date',
    ];
    public function getWeightFormattedAttribute()
    {
        if ($this->is_shippable && $this->weight !== null) {
            return number_format($this->weight, 3) . 'Kg';
        }
        return null;
    }
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
