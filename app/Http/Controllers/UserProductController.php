<?php

namespace App\Http\Controllers;

use App\Models\CartDetail;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use phpDocumentor\Reflection\Types\String_;
use PHPUnit\Exception;

class UserProductController extends Controller
{
    public function list(){
        $products = Product::whereHidden(0)->get();
        return view('homepage', ['products'=>$products]);
    }

    public function show($shortname){
        $product = Product::whereShortName($shortname)->first();
        $color = $product->colors;
        $size = $product->sizes;
        $params = ['product'=>$product, 'color'=>$color, 'size'=>$size];
        if (View::exists($product->shortname)){
            return view($product->short_name, $params);
        }
        else
            return view('defaultproduct', $params);
    }

    public function find(Request $request)
    {
        $request->validate([
            'query' => 'required|max:50',
        ]);

        $products = DB::table('products')->where('name', 'like', '%'.$request->input('query').'%')->where('hidden', '=', 0)->get();
        return view('homepage', ['products'=>$products]);
    }
}
