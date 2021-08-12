<?php

namespace App\Http\Controllers;

use App\Models\CartDetail;
use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use phpDocumentor\Reflection\Types\String_;
use PHPUnit\Exception;

class ProductController extends Controller
{
    public function getProductView($shortname){
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

    public function deleteFromCart(Request $request)
    {
        $cartDetailId = $request->input('cookie_id');
        $cartDetail = CartDetail::whereId($cartDetailId)->first();
        //$cart = $_COOKIE['cart'];
//        $productsInCart = json_decode($cart, true);
//        $productsInCart = array_values($productsInCart);
//        unset($productsInCart[$cookieid]);
//
//        $cart = json_encode($productsInCart);
//        setcookie('cart', $cart, time() + (60*60*24*7));
        $cartDetail->forceDelete();

    }

    public function cartChangeQuantity(Request $request)
    {
        $cartDetailId = $request->input('cookie_id');
        $quantity = $request->input('quantity');
        $cartDetail = CartDetail::whereId($cartDetailId)->first();
        $cartDetail->qty = $quantity;
        $cartDetail->total_price = $cartDetail->price * $cartDetail->qty;
        $cartDetail->save();

        return $cartDetail->total_price;
    }


}
