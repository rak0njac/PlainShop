<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use League\Flysystem\Adapter\NullAdapter;

class OrderDetailController extends Controller
{
    public function list($orderId){
        $order = Order::whereId($orderId)->first();
        $details = OrderDetail::whereOrderId($orderId)->get();

        return view('order-details', ['order'=>$order, 'details'=>$details]);
    }

    public function new(Request $request){
        $request->validate([
            'qty'=>'required|min:1|max:99',
        ]);

        $detail = new OrderDetail();
        $detail->order_id = $request->input('order');
        $detail->product_id = $request->input('product');
        $detail->product_size_id = $request->input('size');
        $detail->product_color_id = $request->input('color');

        $detail->qty = $request->input("qty");
        $detail->price_after_tax = $request->input("price_after_tax");
        $detail->total_price = $detail->price_after_tax * $detail->qty;

        $detail->save();

        $order = Order::whereId($request->input('order'));
        $order->calculateSubtotal();

        return 'SUCCESS';
    }


    public function update(Request $request){
        $request->validate([
            'qty'=>'required|min:1|max:99',
        ]);

        $detail = OrderDetail::whereId($request->input("id"))->first();

        $detail->qty = $request->input("qty");
        $detail->price_after_tax = $request->input("price_after_tax");
        $detail->total_price = $detail->price_after_tax * $detail->qty;

        $detail->save();

        $order = Order::whereId($request->input('order'));
        $order->calculateSubtotal();

        return 'SUCCESS';
    }


    public function delete(Request $request){
        $id = $request->input('id');
        $detail = OrderDetail::whereId($id)->first();
        $order_id = $detail->order_id;
        $detail->delete();

        $order = Order::whereId($order_id);
        $order->calculateSubtotal();

        return 'SUCCESS';
    }
}
