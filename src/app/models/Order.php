<?php

namespace Src\App\Models;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{


    protected $fillable = [
        "payment_method",
        "is_price",
        "shipping_price",
        "total_price",
        "is_paid",
        "paid_at",
        "is_delivered",
        "delivered_at",

    ];


    public function user()
    {
        return $this->hasOne(User::class, localKey: "user");
    }
}
