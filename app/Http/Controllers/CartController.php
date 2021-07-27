<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show() //Used only for displaying meaningful information to the customer viewing his cart. When he completes the order, primary keys are accessed from the cookie itself.
    {
        $cart = $_COOKIE['cart'];
        $productsInCart = json_decode($cart, true);
        $arr = array();

        foreach ($productsInCart['products'] as $product)
        {
            $thumbnail = Product::findOrFail($product['product_id'])->avatar_url;
            $name = Product::findOrFail($product['product_id'])->name;
            $color = optional(ProductColor::find($product['color']))->hex;
            $price = $product['price'];
            $size = optional(ProductSize::find($product['size']))->name;
            $quantity = $product['quantity'];
            $cookieid = $product['cookie_id'];
            array_push($arr, [$thumbnail, $name, $price, $color, $size, $quantity, $cookieid]);
        }
        return view('cart', ['products'=>$arr]);
        //echo '<pre>'; print_r($arr); echo '</pre>';

        //return view('cart', ['products'=>json_decode($cart, true)]);
    }
}
