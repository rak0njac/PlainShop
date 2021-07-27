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

    public function updateCart(Request $request){
        $cookieid = 0;
        $productname = $request->input('product');
        $quantity = $request->input('quantity');
        $price = $request->input('price');
        $productcolor = $request->input('color');
        $productsize = $request->input('size');

        if(isset($_COOKIE['cart']))
        {
            $cart = $_COOKIE['cart'];
            $productsInCart = json_decode($cart, true);
            $lastArray = end($productsInCart['products']);
            $cookieid = $lastArray['cookie_id'] + 1;
        }
        else {
            $cart = null;
            $productsInCart = array('products'=>array());
        }

        $product = ['cookie_id'=>$cookieid, 'product_id'=>$productname, 'quantity'=>$quantity, 'price'=>$price, 'color'=>$productcolor, 'size'=>$productsize];


        foreach($productsInCart['products'] as $p)
        {
            if ($p['product_id'] == $product['product_id'] && $p['color'] == $product['color'] && $p['size'] == $product['size']){
                $product['quantity'] += $p['quantity'];
                $key = array_search($p, $productsInCart['products']);
                unset($productsInCart['products'][$key]);
            }
        }

        array_push($productsInCart['products'], $product);

        $cart = json_encode($productsInCart);

        setcookie('cart', $cart, time() + (60*60*24*7));
        return redirect()->action([CartController::class, 'show']);
//        if (isset($_COOKIE['cart']))
//        {
//            return view('cart', ['products'=>json_decode($cart, true)]);
//        }
//        else echo "Cannot set cookie. Make sure cookies are enabled in your web browser.";
    }
}
