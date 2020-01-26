<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index(){
        return view('backend.image.index');
    }

    public function upload(Request $request){
        $fonts = public_path('fonts/font.ttf');

        if($request->shop == 'shobi'){
            $ovarlay = Image::make(public_path('borders/SHOBI.COM.png'))->resize(800, 800);
        }else if($request->shop == 'baby'){
            $ovarlay = Image::make(public_path('borders/BabyNYouth.png'))->resize(800, 800);
        }else if($request->shop == 'bd'){
            $ovarlay = Image::make(public_path('borders/BDWHOLESALE.png'))->resize(800, 800);
        }
        else{
            $ovarlay = Image::make(public_path('borders/border.png'))->resize(800, 800);
        }

        if($request->hasFile('image')){
            $main = Image::make($request->image)->resize(738, 738);
            $old = Image::make(public_path('borders/discount.png'))->resize(160, 40);
            $image = Image::canvas(800, 800);
            $image->insert($main, 'center');
            $image->insert($ovarlay);
            $image->text('Price: '.$request->price.'/-', 60, 100, function($font){
                $font->file(public_path('fonts/font.ttf'));
                $font->size(28);
                $font->color("#FF0000");
            });
            if($request->old != '0'){
                $image->insert($old, 'top-left', 50, 150);
                $image->text('Price: '.$request->old.'/-', 75, 175, function($font){
                    $font->file(public_path('fonts/font.ttf'));
                    $font->size(18);
                    $font->color("#FF0000");
                });
                $image->line(70, 168, 190, 168, function ($draw) {
                    $draw->color('#f00');
                }); 
            }
            return $image->response('jpg');
        }
        return $request->all();
    }
}
