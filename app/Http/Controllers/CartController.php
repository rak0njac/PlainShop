<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show()
    {
        $cart = $_COOKIE['cart'];
        $productsInCart = json_decode($cart, true);
        $arr = array();

        $product = null;
        $count = 0;
        foreach ($productsInCart['products'] as $product)
        {
            $p = Product::findOrFail($product['product_id']);
            $c = ProductColor::find($product['color']);
            $s = ProductSize::find($product['size']);
            $q = $product['quantity'];
            array_push($arr, [$count=>[$p->name, $c->hex, $s->name, $q]]);
            $count++;
            print_r($arr);
        }

    }
}
