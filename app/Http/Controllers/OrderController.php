<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getAllOrders()
    {
        $orders = Order::all();
        return view('ordermanagement', ['orders'=>$orders]);
    }
}
