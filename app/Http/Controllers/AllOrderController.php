<?php

namespace App\Http\Controllers;

use App\Order;
use App\Payment;
use App\Remark;
use Illuminate\Http\Request;

class AllOrderController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index(){
        $orders = Order::with('courier', 'district')->get();
        // return $orders;
        return view('backend.all.index', compact('orders'));
    }

    public function delete($id){
        Order::where('id', $id)->delete();
        return back()->with('success', 'Order Successfully Deleted!');
    }

    public function single($id){
        // $order = Order::with('shop')->with('courier')->where('id', $id)->get();
        $order = Order::with('shop')->with('courier')->where('id', $id)->first();
        return response()->json($order);
    }

    public function status($id, $status){
        Order::where('id', $id)->update([
            'status' => $status
        ]);

        return 'OK';
    }

    public function dateSearch(Request $request){
        $orders = Order::whereDate('created_at', $request->created)->with('courier', 'district')->get();
        
        return view('backend.all.index', compact('orders'));
    }

    public function remark($id, $remark){
        Remark::create([
            'order_id' => $id,
            'remark' => $remark
        ]);

        return 'OK';
    }

    public function getRemark($id){
        $remarks = Remark::where('order_id', $id)->get();
        return view('backend.all.remark', compact('remarks'));
    }

    public function payment($id, $method, $amount, $remindcode){
        Payment::create([
            'order_id' => $id,
            'payment_method' => $method,
            'amount' => $amount,
            'remind_code' => $remindcode
        ]);

        return 'OK';
    }

    public function getPayments($id){
        $payments = Payment::where('order_id', $id)->get();
        return view('backend.all.payment', compact('payments'));
    }
}
