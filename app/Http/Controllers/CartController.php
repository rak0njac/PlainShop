<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function getCartView()
    {
        if(!Cookie::has('cart'))
        {
            return print_r('No cookie set');
        }
        else {
            $cartId =  Cookie::get('cart');
            $cart = Cart::whereId($cartId)->first();
        }

        return view('cart', ['cart'=>$cart]);
    }


    public function addToCart(Request $request){
        if(!Cookie::has('cart'))
        {
            $cart = new Cart();
            $cart->save();
            Cookie::queue('cart', $cart->id, 60*60*24*7);
        }
        else {
            $cartId =  Cookie::get('cart');
            Log::info('Cart id extracted from cookie:'.print_r($cartId));
            $cart = Cart::whereId($cartId)->first();
        }

        $product = Product::whereId($request->input('product'))->first();
        $color = ProductColor::whereId($request->input('color'))->first();
        $size = ProductSize::whereId($request->input('size'))->first();

        $quantity = $request->input('quantity');
        $price = $request->input('price');
        $totalPrice = $quantity * $price;

        $check = false;     //Check if we will just be increasing quantity for a product already in cart, or adding a new product to the cart

        foreach($cart->details as $detail)
        {
            Log::info('Entered foreach loop');
            if ($detail->product == $product && $detail->productColor == $color && $detail->productSize == $size){
                Log::info('Entered if loop');
                $detail->qty += $quantity;
                $detail->price = $price;
                $detail->total_price = $detail->qty * $detail->price;
                $detail->save();
                $check = true;
            }
        }

        if(!$check)
        {
            Log::info('Check is false');
            $detail = new CartDetail();
            $detail->cart_id = $cart->id;
            $detail->product_id = $product->id;
            $detail->qty = $quantity;
            $detail->price = $price;
            $detail->product_color_id = optional($color)->id;
            $detail->product_size_id = optional($size)->id;
            $detail->total_price = $totalPrice;
            $detail->save();
        }
        return redirect()->action([CartController::class, 'getCartView']);
    }





    public function showOrderForm(){
        if(isset($_COOKIE['cart'])) {
            $cart = $_COOKIE['cart'];
            $productsInCart = json_decode($cart, true);
            //Log::info($productsInCart);
            $arr = array();

            foreach ($productsInCart as $product)
            {
                $p =            $product['product_id'];
                //Log::info($p);
                $thumbnail =    Product::findOrFail($p)->avatar_url;
                $name =         Product::findOrFail($p)->name;
                $color =        optional(ProductColor::find($product['color']))->hex;
                $price =        $product['price'];
                $size =         optional(ProductSize::find($product['size']))->name;
                $quantity =     $product['quantity'];


                $cookieid =     array_search($product,array_values($productsInCart));
                array_push($arr, [$thumbnail, $name, $price, $color, $size, $quantity, $cookieid]);
            }
            return view('orderform', ['products'=>$arr]);        }
        else {
            return redirect()->action([HomeController::class, 'show']);
        }
    }

    public function finishOrder(Request $request){
        $order = new Order();

        $order->customer_name = $request->input('name');
        $order->customer_address = $request->input('address');
        $order->customer_town = $request->input('town');
        $order->customer_postcode = $request->input('postcode');
        $order->customer_phone = $request->input('phone');
        $order->customer_email = $request->input('email');
        $order->status = 'New';
        $order->datetime = Carbon::now()->toDateTimeString();

        $order->save();

        $cart = $_COOKIE['cart'];
        $productsInCart = json_decode($cart, true);

        $subtotal = 0;

        foreach($productsInCart as $product)
        {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $product['product_id'];
            $orderDetail->product_color_id = $product['color'];
            $orderDetail->product_size_id = $product['size'];
            $orderDetail->price_after_tax = $product['price'];
            $orderDetail->qty = $product['quantity'];
            $orderDetail->total_price = $orderDetail->price_after_tax * $orderDetail->qty;
            $orderDetail->tax = 20;
            $orderDetail->price = $orderDetail->price_after_tax * ((100 - $orderDetail->tax)/100);
            $orderDetail->save();
            $subtotal+=$orderDetail->total_price;
        }

        $order->subtotal_price = $subtotal;
        $order->save();

        return view('orderconfirmation', ['order'=>$order]);
    }
}
