<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The vouchers that belong to the product.
     */
    public function vouchers()
    {
        return $this->belongsToMany('App\Voucher');
    }
}
