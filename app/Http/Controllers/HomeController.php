<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function getActiveProducts() {
        $products = Product::whereHidden(0)->get();
        Cookie::queue('test', 'TESTCOOKIE', 10);
        return view('homepage', ['products'=>$products]);
}
    public function findActiveProduct(Request $request){
        $products = DB::table('products')->where('name', 'like', '%'.$request->input('query').'%')->where('hidden', '=', 0)->get();
        return view('homepage', ['products'=>$products]);
    }
}
