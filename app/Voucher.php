<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    /**
     * Get the discount record associated with the voucher.
     */
    public function discount()
    {
        return $this->hasOne('App\Discount');
    }
}
