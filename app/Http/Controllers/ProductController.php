<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use phpDocumentor\Reflection\Types\String_;
use PHPUnit\Exception;

class ProductController extends Controller
{
    function show($shortname){
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

    public function updateCart($product, $quantity, $productcolor = null, $productsize = null){
        setcookie('cart', json_encode([$product, $quantity, $productcolor, $productsize]), time() + (60*60*24*7));
        if (isset($_COOKIE['cart']))
            echo 'Cookie set successfully!';
        else echo 'Fuck you!';
    }
}
