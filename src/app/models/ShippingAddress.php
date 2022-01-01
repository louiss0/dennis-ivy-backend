<?php

namespace Src\App\Models;


use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{

    protected $fillable = [
        "address",
        "city",
        "postal_code",
        "country",
        "shipping_price"
    ];

    public function order()
    {
        return $this->hasOne(Order::class, localKey: "order");
    }
}
