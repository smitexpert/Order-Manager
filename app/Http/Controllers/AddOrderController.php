<?php

namespace App\Http\Controllers;

use App\Courier;
use App\District;
use App\Order;
use App\OrderDistrict;
use App\Shop;
use Carbon\Carbon;
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
        $districts = District::all();
        return view('backend.addorder.index', compact('shops', 'couriers', 'districts'));
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
            'customerDistrict' => 'required',
        ]);

        $total = (($request->productPrice * $request->productQuantity) + $request->shippingCharge) - $request->discount;
        $id = Order::insertGetId([
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
            'created_at' => Carbon::now()
        ]);

        OrderDistrict::create([
            'order_id' => $id,
            'name' => $request->customerDistrict
        ]);

        // return $request->all();
        return back()->with('success', 'Order Successfully Added!')->with('shop', $request->shop);
    }

    public function charge($id){
        $response = Courier::where('id', $id)->first();
        return response()->json($response);
    }
}
