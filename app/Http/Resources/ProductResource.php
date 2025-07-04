<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'is_expire' => $this->is_expire,
            'expire_at' => $this->expire_at?->format('Y-m-d'),
            'is_shippable' => $this->is_shippable,
           'weight' => $this->weight,
            'weight_formatted' => $this->when($this->is_shippable, number_format($this->weight, 3) . 'Kg'),
        ];
    }
}