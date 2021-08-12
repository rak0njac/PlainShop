<?php

namespace App\Http\Controllers;

use App\Http\Services\ProductService;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ManagerController extends AgentController
{
    public function getAllAgents()
    {
        $agents = User::whereType('agent')->get();
        return view('agentmanagement', ['agents'=>$agents]);
    }

    public function getAllProducts()
    {
        $products = Product::all();
        return view('productmanagement', ['products'=>$products]);
    }

    public function findAgent(Request $request){}
    public function findProduct(Request $request){}

    public function addAgent(Request $request){}
    public function addProduct(Request $request){}

    public function updateAgent(Request $request){}
    public function updateProduct(Request $request){}
}
