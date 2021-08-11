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
        }
        else {
            $productsInCart = array();
        }


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
            }
        }

        $productsInCart = $tempArr;

        if(!$check)
            array_push($productsInCart, ["product_id"=>$productId, "quantity"=>$quantity, "price"=>$price, "color"=>$color, "size"=>$size]);

        $cart = json_encode($productsInCart);

        setcookie('cart', $cart, time() + (60*60*24*7));
        return redirect()->action([CartController::class, 'show']);
    }

    public function deleteFromCart(Request $request)
    {
        $cookieid = $request->input('cookie_id');
        $cart = $_COOKIE['cart'];
        $productsInCart = json_decode($cart, true);
        $productsInCart = array_values($productsInCart);
        unset($productsInCart[$cookieid]);

        $cart = json_encode($productsInCart);
        setcookie('cart', $cart, time() + (60*60*24*7));
    }

    public function cartChangeQuantity(Request $request)
    {
        $cookieid = $request->input('cookie_id');
        $quantity = $request->input('quantity');
        $cart = $_COOKIE['cart'];
        $productsInCart = json_decode($cart, true);
        $productsInCart = array_values($productsInCart);
        $productsInCart[$cookieid]['quantity'] = $quantity;


        $cart = json_encode($productsInCart);
        setcookie('cart', $cart, time() + (60*60*24*7));
    }

    public function adminShowProducts()
    {
        $products = Product::all();
        return view('productmanagement', ['products'=>$products]);
    }
}
