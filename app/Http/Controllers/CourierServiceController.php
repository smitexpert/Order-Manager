<?php

namespace App\Http\Controllers;

use App\Courier;
use Illuminate\Http\Request;

class CourierServiceController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index(){
        $couriers = Courier::all();
        return view('backend.courier.index', compact('couriers'));
    }

    public function store(Request $request){
        $request->validate([
            'courierName' => 'string|required',
            'courierCharge' => 'numeric|required'
        ]);

        Courier::create([
            'name' => $request->courierName,
            'charge' => $request->courierCharge
        ]);

        return back()->with('success', 'Courier Successfully Added!');
    }

    public function delete($id){
        Courier::findOrFail($id)->delete();
        return back()->with('success', 'Courier Successfully Deleted!');
    }
}
