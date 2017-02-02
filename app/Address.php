<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $fillable=['city','state','country','zip_code','address'];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}
