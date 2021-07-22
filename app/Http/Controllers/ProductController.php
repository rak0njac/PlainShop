<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class ProductController extends Controller
{
    function show($shortname){
        $product = Product::whereShortName($shortname)->first();
        $color = $product->colors;
        try {
            return view($product->short_name, ['product'=>$product, 'color'=>$color]);
        }
        catch (\Exception $e){
            return view('defaultproduct', ['product'=>$product, 'color'=>$color]);
        }
    }
}
