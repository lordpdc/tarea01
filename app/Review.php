<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $fillable=['critic_name','title','content','date','product_id'];
    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
