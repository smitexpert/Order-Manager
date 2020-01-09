<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class AllOrderController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index(){
        $orders = Order::all();
        return view('backend.all.index', compact('orders'));
    }
}
