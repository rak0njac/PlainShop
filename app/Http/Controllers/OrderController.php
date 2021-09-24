<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function save(Request $request)
    {
        if(empty($request->input('id'))){
            $order = new Order;
            $order->tracking_nr = 0;
            $order->status = 'New';
            $order->datetime = Carbon::now()->toDateTimeString();
        }
        else {
            $order = Order::whereId($request->input('id'))->first();
            $order->tracking_nr = $request->input('tracking_nr');
            $order->status = $request->input('status');
        }

        $order->customer_name = $request->input('customer_name');
        $order->customer_address = $request->input('customer_address');
        $order->customer_phone = $request->input('customer_phone');
        $order->customer_email = $request->input('customer_email');


        $order->save();
        return $order->id;
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

    public function getNewOrderView(){
        $products = Product::all()->sortBy('short_name');
        return view('new-order', ['products'=>$products]);
    }

    public function deleteDetail(Request $request){
        $id = $request->input('id');
        $detail = OrderDetail::whereId($id)->first();
        $order_id = $detail->order_id;
        $detail->delete();

        $this->calculateSubtotal($order_id);


        return 'SUCCESS';
    }

    private function calculateSubtotal($order_id){
        $order = Order::whereId($order_id)->first();
        $sum = 0;
        foreach($order->details as $detail){
            $sum += $detail->total_price;
        }
        $order->subtotal_price = $sum;
        $order->save();
    }

    public function saveDetail(Request $request){
        if(!empty($request->input("id")))
            $detail = OrderDetail::whereId($request->input("id"))->first();
        else {
            $detail = new OrderDetail();
            $detail->order_id = $request->input('order');
            $detail->product_id = $request->input('product');
            $detail->product_size_id = $request->input('size');
            $detail->product_color_id = $request->input('color');
        }

        $detail->qty = $request->input("qty");
        $detail->price_after_tax = $request->input("price_after_tax");
        $detail->total_price = $detail->price_after_tax * $detail->qty;

        $detail->save();

        $this->calculateSubtotal($request->input('order'));

        return 'SUCCESS';
    }
}
