<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index(){
        $shops = Shop::all();
        return view('backend.shop.index', compact('shops'));
    }

    public function store(Request $request){

        $request->validate([
            'shopName' => 'string|required'
        ]);

        Shop::create([
            'name' => $request->shopName
        ]);

        return back()->with('success', 'Shop Successfully Added!');
    }

    public function delete($id){
        Shop::findOrFail($id)->delete();

        return back()->with('success', 'Shop Successfully Deleted!');
    }

    public function upload(Request $request, $id){
        // $request->validate([
        //     'shopLogo' => 'required|image'
        // ]);

        $name = Shop::where('id', $id)->first();
        $name = $name->name;

        // $request->shopLogo->storeAs('shop_logos', $name);

        $path = $request->file('shopLogo')->storeAs(
            'shop_logos', $name.".".$request->file('shopLogo')->getClientOriginalExtension()
        );

        // $path = $request->file('shopLogo')->store($name.'.'.$request->file('shopLogo')->getClientOriginalExtension());

        // return $path;

        Shop::where('id', $id)->update([
            'shop_logo' => $path
        ]);

        return back()->with('success', 'Shop Logo Uploaded Successfully!');
    }
}
