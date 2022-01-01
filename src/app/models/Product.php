<?php

namespace Src\App\Models;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{



    protected $fillable = [
        "name",
        "description",
        "brand",
        "category",
        "rating",
        "count_in_stock",
        "price",
        "image",
        "num_reviews",
    ];

    public function user()
    {
        return $this->hasOne(User::class, localKey: "user");
    }
}
