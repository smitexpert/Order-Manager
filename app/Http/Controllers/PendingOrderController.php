<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class PendingOrderController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index(){
        $orders = Order::where('status', 'pending')->get();
        return view('backend.pending.index', compact('orders'));
    }

    public function shipped($id){
        Order::where('id', $id)->update([
            'status' => 'shipped'
        ]);

        return back()->with('success', 'Order successfully Shipped!');
    }
}
