<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    //
    protected $fillable=['name','last_name','address_id'];

    public function address()
    {
        return $this->hasOne(Address::class);
    }


}
