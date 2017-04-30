<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 *
 * @property array[Voucher] vouchers
 * @property Voucher voucher
 * @property float price
 * @property string name
 *
 * @package App
 */
class Product extends Model
{
    const MAX_DISCOUNT = 60;

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

    /**
     * Return price with discount\
     *
     * @var Voucher $voucher
     * @return float price
     */
    public function getPrice() {
        if (!count($this->vouchers)) {
            return $this->price;
        }

        $discount = 0;

        foreach ($this->vouchers as $voucher) {
            if(strtotime($voucher->start_date) < strtotime("now") ) {
                $discount += $voucher->discount->value;
            }

            if ($discount > self::MAX_DISCOUNT) {
                break;
            }
        }
        // calculate discount  price * discount / 1000
        $discount = $this->price * ($discount > self::MAX_DISCOUNT ? self::MAX_DISCOUNT : $discount) / 100;

        return $this->price - $discount ;

    }
}
