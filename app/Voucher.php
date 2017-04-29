<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        return $this->hasOne('App\Discount');
    }

    public function products()
    {
        return $this->belongsToMany('App\Discount');
    }
}
