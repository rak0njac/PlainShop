<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function show() {
        $products = Product::whereHidden(0)->get();
        return view('homepage', ['products'=>$products]);
}
    public function search(Request $request){
        $products = DB::table('products')->where('name', 'like', '%'.$request->input('query').'%')->where('hidden', '=', 0)->get();
        return view('homepage', ['products'=>$products]);
    }
}
