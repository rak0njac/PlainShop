<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use League\Flysystem\Adapter\NullAdapter;

class UserOrderController extends Controller
{
    public function new(Request $request){
        if ($request->isMethod('get')) {
            if(!Cookie::has('cart'))
            {
                return back()->withErrors([
                    'error' => "Cookie not set. If you didn't access this page manually by URL, contact webmaster.",
                ]);
            }
            $cartId =  Cookie::get('cart');
            $cart = Cart::whereId($cartId)->first();
            Log::info($cart);

            return view('orderform', ['cart'=>$cart]);
        }

        $request->validate([
            'name'=>'required|max:50',
            'address'=>'required|max:50',
            'postcode'=>'required|numeric|size:5',
            'town'=>'required|max:50',
            'phone'=>'required|numeric|max:20',
        ]);

        $order = new Order();

        $order->customer_name = $request->input('name');
        $order->customer_address = $request->input('address').', '.$request->input('postcode').' '.$request->input('town');
        $order->customer_phone = $request->input('phone');
        $order->customer_email = $request->input('email');
        $order->status = 'New';
        $order->datetime = Carbon::now()->toDateTimeString();

        $order->save();

        $cartId =  Cookie::get('cart');
        $cart = Cart::whereId($cartId)->first();

        $subtotal = 0;

        foreach($cart->details as $detail)
        {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $detail->product_id;
            $orderDetail->product_color_id = $detail->product_color_id;
            $orderDetail->product_size_id = $detail->product_size_id;
            $orderDetail->price_after_tax = $detail->price;
            $orderDetail->qty = $detail->qty;
            $orderDetail->total_price = $orderDetail->price_after_tax * $orderDetail->qty;
            $orderDetail->tax = 20;
            $orderDetail->price = $orderDetail->price_after_tax * ((100 - $orderDetail->tax)/100);
            $orderDetail->save();
            $subtotal+=$orderDetail->total_price;
        }

        $order->subtotal_price = $subtotal;
        $order->save();

        Cookie::expire('cart');

        return redirect('/show-order-confirmation')->with(['order'=>$order]);
    }

    public function showConfirmation(){
        $order = Session::get('order');
        if(is_null($order)){
            return redirect('/');
        }
        return view('orderconfirmation', ['order'=>$order]);
    }
}
