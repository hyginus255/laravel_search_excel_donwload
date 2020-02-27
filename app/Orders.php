<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //

    protected $table = 'orders';
    protected $primaryKey = 'orderNumber';

    public function orderLine()
    {
        return $this->hasOne('App\OrderLines', 'orderNumber','orderNumber');
    }

    public function customer()
    {
        return $this->hasOne('App\Customers', 'customerNumber','customerNumber');
    }
}
