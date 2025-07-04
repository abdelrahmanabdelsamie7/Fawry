<?php
namespace App\Models;
use App\Models\{Customer,CartItem};
use App\traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory, UsesUuid;
    protected $table = 'carts';
    protected $fillable = ['customer_id'];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}