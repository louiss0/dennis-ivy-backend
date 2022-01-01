<?php

namespace Src\App\Models;


use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{



    protected $fillable = [
        "name", "quantity", "price", "image",
    ];

    public function order()
    {
        return $this->hasOne(Order::class, localKey: "order");
    }

    public function product()
    {
        return $this->hasOne(
            Product::class,
            localKey: "product"
        );
    }
}
