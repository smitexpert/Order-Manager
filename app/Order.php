<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $fillable = [
        'order_id',
        'customer_name',
        'customer_mobile',
        'customer_address',
        'product_name',
        'product_price',
        'product_quantity',
        'shipping_charge',
        'discount',
        'total_charge',
        'delivery_date',
        'status',
        'shop_id',
        'courier_id'
    ];

    
}
