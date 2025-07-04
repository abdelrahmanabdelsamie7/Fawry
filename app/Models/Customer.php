<?php
namespace App\Models;
use App\Models\Cart;
use App\traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, UsesUuid;
    protected $table = 'customers';
    protected $fillable = ['name','email','balance'];

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
}
