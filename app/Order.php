<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

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

    public function courier(){
        return $this->hasOne('App\Courier', 'id', 'courier_id');
    }

    public function shop(){
        return $this->hasOne('App\Shop', 'id', 'shop_id');
    }

    public function district(){
        return $this->hasMany('App\OrderDistrict', 'order_id', 'id');
    }

    public function payments(){
        return $this->hasMany('App\Payment', 'order_id', 'id');
    }

    public function remarks(){
        return $this->hasMany('App\Remark', 'order_id', 'id');
    }
}
