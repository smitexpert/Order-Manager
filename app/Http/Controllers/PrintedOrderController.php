<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class PrintedOrderController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index(){
        $orders = Order::where('status', 'printed')->get();
        return view('backend.print.index', compact('orders'));
    }
}
