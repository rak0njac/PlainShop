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

    public function getChangeProductThumbnailView($productid){
        $product = Product::whereId($productid)->first();
        return view('change-product-thumbnail', ['product'=>$product]);
    }

    public function changeProductThumbnail(Request $request)
    {
        $product = Product::whereId($request->input('product'))->first();
        if($request->file('file')->extension() == 'jpg' ||
            $request->file('file')->extension() == 'bmp' ||
            $request->file('file')->extension() == 'png' ||
            $request->file('file')->extension() == 'webp')
        {
            $file = $request->file('file')->store('product-thumbnails', ['disk'=>'public']);
            $product->avatar_url = $file;
            $product->save();
            return redirect()->action([ManagerController::class, 'getChangeProductThumbnailView'], ['productid'=>$product->id]);
        }
    else echo 'File extension must be jpg/bmp/png/webp';
    }

    public function findAgent(Request $request){}
    public function findProduct(Request $request){}

    public function addAgent(Request $request){}
    public function addProduct(Request $request){}

    public function updateAgent(Request $request){}
    public function updateProduct(Request $request){}
}
