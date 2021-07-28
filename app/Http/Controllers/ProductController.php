<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        //$cookieId = 0;
        $productId = $request->input('product');
        $quantity = $request->input('quantity');
        $price = $request->input('price');
        $color = $request->input('color');
        $size = $request->input('size');

        if(isset($_COOKIE['cart']))
        {
            $cart = $_COOKIE['cart'];
            $productsInCart = json_decode($cart, true);
            $productsInCart = array_values($productsInCart);
            //$lastArray = end($productsInCart);
            //$cookieId = key($lastArray) + 1;
        }
        else {
            $cart = null;
            //$productsInCart = array('products'=>array());
            $productsInCart = array();
            //$productsInCart = array(["cookieId"=>cookieId, "product"=>["product_id"=>$productId, "quantity"=>$quantity, "price"=>$price, "color"=>$color, "size"=>$size]]);
        }

        //$product = ['cookie_id'=>$cookieId, 'product_id'=>$productId, 'quantity'=>$quantity, 'price'=>$price, 'color'=>$color, 'size'=>$size];

        $tempArr = $productsInCart;
        $check = false;

        foreach($productsInCart as $p)
        {
            if ($p['product_id'] == $productId && $p['color'] == $color && $p['size'] == $size){
                $quantity += $p['quantity'];
                $key = array_search($p,array_values($productsInCart));
                $tempArr[$key]['quantity'] = $quantity;
                Log::info($key);
                $check = true;
                //unset($productsInCart[$key]);
                //$key = array_search($p, $productsInCart['products']);
                //unset($productsInCart['products'][$key]);
            }
        }

        $productsInCart = $tempArr;

        if(!$check)
            array_push($productsInCart, ["product_id"=>$productId, "quantity"=>$quantity, "price"=>$price, "color"=>$color, "size"=>$size]);

        $cart = json_encode($productsInCart);

        setcookie('cart', $cart, time() + (60*60*24*7));
        return redirect()->action([CartController::class, 'show']);
//        if (isset($_COOKIE['cart']))
//        {
//            return view('cart', ['products'=>json_decode($cart, true)]);
//        }
//        else echo "Cannot set cookie. Make sure cookies are enabled in your web browser.";
    }

    public function deleteFromCart(Request $request)
    {
        $cookieid = $request->input('cookie_id');
        $cart = $_COOKIE['cart'];
        $productsInCart = json_decode($cart, true);
        $productsInCart = array_values($productsInCart);
        //$key = array_search($cookieid, $productsInCart);  // $productsInCart['products']);
        //Log::info(array_keys($productsInCart['products']));
        unset($productsInCart[$cookieid]);

//        $count = 0;
//        foreach($productsInCart['products'] as $p)
//        {
//            $p['cookie_id'] = $count;
//            $count++;
//        }

        //$productsInCart['products'] =
        //Log::info(array_values($productsInCart));
        //$productsInCart = array_map('array_values', $productsInCart);
        //$a = array_column($productsInCart, 'cookieId');
//        Log::info($productsInCart)
//        Log::info(array_column($productsInCart, 'cookieId'));
        //$productsInCart = array_values($productsInCart);

        $cart = json_encode($productsInCart);
        setcookie('cart', $cart, time() + (60*60*24*7));
        //return (string)$key;
    }
}
