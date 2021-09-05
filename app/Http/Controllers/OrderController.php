<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function save(Request $request)
    {
        $order = Order::whereId($request->input('id'))->first();
        $order->customer_name = $request->input('customer_name');
        $order->customer_address = $request->input('customer_address');
        $order->customer_phone = $request->input('customer_phone');
        $order->customer_email = $request->input('customer_email');

        $order->save();
        return 'SUCCESS';
    }

    public function delete(Request $request)
    {
        $order = Order::whereId($request->input('id'))->first();
        $order->delete();
        return 'SUCCESS';
    }

    public function search(Request $request)
    {
        $id = $request->input('id');
        $customer_name = $request->input('customer_name');
        $customer_phone = $request->input('customer_phone');
        $customer_email = $request->input('customer_email');
        $tracking_nr = $request->input('tracking_nr');

        return Order::where('id', 'like', '%'.$id.'%')
            ->where('customer_name', 'like', '%'.$customer_name.'%')
            ->where('customer_phone', 'like', '%'.$customer_phone.'%')
            ->where('customer_email', 'like', '%'.$customer_email.'%')
            ->where('tracking_nr', 'like', '%'.$tracking_nr.'%')
            ->get();
    }
}
