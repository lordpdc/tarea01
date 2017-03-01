<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable=['name','price','description','seller_id'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function reviews()
    {
        return $this->belongsTo(Review::class);
    }

}
