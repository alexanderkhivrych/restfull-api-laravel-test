<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Voucher
 *
 * @property Discount discount
 * @property string start_date
 * @property  string end_date
 * @package App
 */
class Voucher extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['discount_id', 'start_date', 'end_date'];

    /**
     * Get the discount record associated with the voucher.
     */
    public function discount()
    {
        return $this->belongsTo('App\Discount');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
