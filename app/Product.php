<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'price'];

    /**
     * The vouchers that belong to the product.
     */
    public function vouchers()
    {
        return $this->belongsToMany('App\Voucher');
    }
}
