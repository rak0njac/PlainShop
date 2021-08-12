<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function getAllOrders()
    {
        $orders = Order::all();
        return view('ordermanagement', ['orders'=>$orders]);
    }

    public function findOrder(Request $request){}
    public function addOrder(Request $request){}
    public function updateOrder(Request $request){}
}
