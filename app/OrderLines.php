<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderLines extends Model
{
    protected $table = 'orderdetails';
    protected $primaryKey = 'orderNumber';
}
