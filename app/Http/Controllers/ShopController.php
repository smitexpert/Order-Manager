<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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
            'shopName' => 'string|required',
            'shopContact' => 'numeric|required'
        ]);

        Shop::create([
            'name' => $request->shopName,
            'shop_contact' => $request->shopContact
        ]);

        return back()->with('success', 'Shop Successfully Added!');
    }

    public function delete($id){
        Shop::findOrFail($id)->delete();

        return back()->with('success', 'Shop Successfully Deleted!');
    }

    public function upload(Request $request, $id){
        $request->validate([
            'shopLogo' => 'required|image'
        ]);

        $name = Shop::where('id', $id)->first();
        $name = $name->name;

        // $path = $request->file('shopLogo')->storeAs(
        //     'shop_logos', $name.".".$request->file('shopLogo')->getClientOriginalExtension()
        // );

        $image = $request->file('shopLogo');

        Image::make($image)->save(base_path("public/uploads/shop_logos/").$name.'.'.$image->getClientOriginalExtension());

        $path = "/uploads/shop_logos/".$name.'.'.$image->getClientOriginalExtension();

        // return $path;

        Shop::where('id', $id)->update([
            'shop_logo' => $path
        ]);

        return back()->with('success', 'Shop Logo Uploaded Successfully!');
    }

    public function get($id){
        $data = Shop::find($id);
        return response()->json($data);
    }

    public function update(Request $request){
        Shop::where('id', $request->shopId)->update([
            'name' => $request->shopName,
            'shop_contact' => $request->shopContact
        ]);

        return 'OK';
    }
}
