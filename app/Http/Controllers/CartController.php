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
            $name = Product::findOrFail($product['product_id'])->name;
            $color = optional(ProductColor::find($product['color']))->hex;
            $size = optional(ProductSize::find($product['size']))->name;
            $quantity = $product['quantity'];
            array_push($arr, [$name, $color, $size, $quantity]);
        }
        return view('cart', ['products'=>$arr]);
        //echo '<pre>'; print_r($arr); echo '</pre>';

        //return view('cart', ['products'=>json_decode($cart, true)]);
    }
}
