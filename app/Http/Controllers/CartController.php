<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function show() //Used only for displaying meaningful information to the customer viewing his cart. When he completes the order, primary keys are accessed from the cookie itself.
    {
        $cart = $_COOKIE['cart'];
        $productsInCart = json_decode($cart, true);
        //Log::info($productsInCart);
        $arr = array();

        foreach ($productsInCart as $product)
        {
            $p = $product['product_id'];
            //Log::info($p);
            $thumbnail = Product::findOrFail($p)->avatar_url;
            $name = Product::findOrFail($p)->name;
            $color = optional(ProductColor::find($product['color']))->hex;
            $price = $product['price'];
            $size = optional(ProductSize::find($product['size']))->name;
            $quantity = $product['quantity'];


            $cookieid = array_search($product,array_values($productsInCart));
            array_push($arr, [$thumbnail, $name, $price, $color, $size, $quantity, $cookieid]);
        }
        return view('cart', ['products'=>$arr]);
        //echo '<pre>'; print_r($arr); echo '</pre>';

        //return view('cart', ['products'=>json_decode($cart, true)]);
    }
}
