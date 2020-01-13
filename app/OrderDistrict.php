<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDistrict extends Model
{
    protected $fillable = [
        'order_id',
        'name'
    ];
}
