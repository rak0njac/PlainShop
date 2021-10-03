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
use League\Flysystem\Adapter\NullAdapter;

class OrderController extends Controller
{
    public function list()
    {
        $orders = Order::all();
        return view('ordermanagement', ['orders'=>$orders]);
    }

    public function new(Request $request){
        // GET
        if ($request->isMethod('get')) {
            $products = Product::all()->sortBy('short_name');
            return view('new-order', ['products'=>$products]);
        }

        // POST
        $order = new Order;
        $order->tracking_nr = 0;
        $order->status = 'New';
        $order->datetime = Carbon::now()->toDateTimeString();

        $order->customer_name = $request->input('customer_name');
        $order->customer_address = $request->input('customer_address');
        $order->customer_phone = $request->input('customer_phone');
        $order->customer_email = $request->input('customer_email');

        $order->save();
        return $order->id;
    }

    public function update(Request $request)
    {
        $request->validate([
            'customer_name'=>'required|max:50',
            'customer_address'=>'required|max:150',
            'customer_phone'=>'required|numeric|max:20',
        ]);

        $order = Order::whereId($request->input('id'))->first();
        $order->tracking_nr = $request->input('tracking_nr');
        $order->status = $request->input('status');


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

    public function find(Request $request)
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
}
