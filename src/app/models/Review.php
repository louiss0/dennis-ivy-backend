<?php

namespace Src\App\Models;


use Illuminate\Database\Eloquent\Model;

class Review extends Model
{


    protected $fillable = [
        "name", "rating", "comment",
    ];



    public function user()
    {
        return $this->hasOne(User::class, localKey: "user");
    }

    public function product()
    {
        return $this->hasOne(User::class, localKey: "product");
    }
}
