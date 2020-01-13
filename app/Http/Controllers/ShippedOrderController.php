<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class ShippedOrderController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index(){
        $orders = Order::where('status', 'shipped')->get();
        return view('backend.shipped.index', compact('orders'));
    }

    public function print($id){
        $order = Order::where('id', $id)->with('courier', 'shop', 'district', 'payments')->first();
        // return dd($order);
        return view('backend.print.single', compact('order'));
    }
}
