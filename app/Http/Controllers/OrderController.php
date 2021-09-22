<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
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
        $order->tracking_nr = $request->input('tracking_nr');
        $order->status = $request->input('status');

//        if(!empty($request->input('tracking_nr')))
//            $order->tracking_nr = $request->input('tracking_nr');
//        if(!empty($request->input('status')))
//            $order->status = $request->input('status');


        $order->save();
        return 'SUCCESS';
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $order = Order::whereId($id)->first();
        $orderdetails = OrderDetail::whereOrderId($id)->get();
        foreach($orderdetails as $od){
            $od->delete();
        }
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
        $status = $request->input('status');

        $orders = Order::   where('id', 'like', '%'.$id.'%')
                            ->where('customer_name', 'like', '%'.$customer_name.'%')
                            ->where('customer_phone', 'like', '%'.$customer_phone.'%')
                            ->where('customer_email', 'like', '%'.$customer_email.'%')
                            ->where('tracking_nr', 'like', '%'.$tracking_nr.'%')->get();

        if($status == "Any")
            return $orders;
        else
            return $orders->where('status', '=', $status);
    }

    public function getOrderDetailsView($orderId){
        $order = Order::whereId($orderId)->first();
        $details = OrderDetail::whereOrderId($orderId)->get();

        return view('order-details', ['order'=>$order, 'details'=>$details]);
    }

    public function deleteDetail(Request $request){
        $id = $request->input('id');

        OrderDetail::whereId($id)->delete();

        return 'SUCCESS';
    }

    public function saveDetail(Request $request){
        $detail = OrderDetail::whereId($request->input("id"))->first();

        $detail->qty = $request->input("qty");
        $detail->price_after_tax = $request->input("price_after_tax");
        $detail->total_price = $detail->price_after_tax * $detail->qty;

        $detail->save();

        return 'SUCCESS';
    }
}
