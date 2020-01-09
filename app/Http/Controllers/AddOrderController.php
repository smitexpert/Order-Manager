<?php

namespace App\Http\Controllers;

use App\Courier;
use App\Order;
use App\Shop;
use Illuminate\Http\Request;

class AddOrderController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index(){
        $shops = Shop::all();
        $couriers = Courier::all();
        return view('backend.addorder.index', compact('shops', 'couriers'));
    }

    public function store(Request $request){
        $request->validate([
            'shop' => 'required',
            'customerName' => 'string|required',
            'customerMobile' => 'numeric|required',
            'customerAddress' => 'required',
            'courier' => 'required',
            'productName' => 'required',
            'productPrice' => 'required',
            'productQuantity' => 'required',
            'shippingCharge' => 'required',
            'discount' => 'required',
            'totalCharge' => 'required',
            'deliveryDate' => 'required',
        ]);

        $total = (($request->productPrice * $request->productQuantity) + $request->shippingCharge) - $request->discount;
        Order::create([
            'order_id' => time(),
            'customer_name' => $request->customerName,
            'customer_mobile' => $request->customerMobile,
            'customer_address' => $request->customerAddress,
            'product_price' => $request->productPrice,
            'product_name' => $request->productName,
            'product_quantity' => $request->productQuantity,
            'shipping_charge' => $request->shippingCharge,
            'discount' => $request->discount,
            'total_charge' => $total,
            'delivery_date' => $request->deliveryDate,
            'shop_id' => $request->shop,
            'courier_id' => $request->courier,
        ]);

        // return $request->all();
        return back()->with('success', 'Order Successfully Added!');
    }
}
