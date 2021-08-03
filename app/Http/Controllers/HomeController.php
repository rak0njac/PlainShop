<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function show() {
        $products = Product::whereHidden(0)->get();
        return view('homepage', ['products'=>$products]);
}
}
