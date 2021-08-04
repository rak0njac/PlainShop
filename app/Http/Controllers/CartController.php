<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Carbon\Carbon;
use http\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function show() // Used only for displaying meaningful information to the customer viewing his cart. When he completes the order, primary keys are accessed from the cookie itself.
    {
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
        return view('cart', ['products'=>$arr]);
        //echo '<pre>'; print_r($arr); echo '</pre>';

        //return view('cart', ['products'=>json_decode($cart, true)]);
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

        //setcookie('cart', time() - 3600);
        //return redirect()->action([HomeController::class, 'show']);
        return view('orderconfirmation', ['order'=>$order]);
    }
}
