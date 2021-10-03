<?php

namespace App\Http\Controllers;

use App\Models\CartDetail;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use phpDocumentor\Reflection\Types\String_;
use PHPUnit\Exception;

class ProductController extends Controller
{
    public function list(){
        $products = Product::all();
        return view('productmanagement', ['products'=>$products]);
    }

    public function changeThumbnail(Request $request)
    {
        if($request->method()=='GET'){
            $product = Product::whereId(0);//TODO)->first();
            return view('change-product-thumbnail', ['product'=>$product]);
        }

        $request->validate([
            'file'=>'mimes:jpg,bmp,png,webp|max:5120',
        ]);

        $product = Product::whereId($request->input('product'))->first();
        $file = $request->file('file')->store('product-thumbnails', ['disk'=>'public']);
        $product->avatar_url = $file;
        $product->save();
        return redirect()->action([ProductController::class, 'changeThumbnail'], ['productid'=>$product->id]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'SKU'=>'required|max:50',
            'name'=>'required|max:150',
            'short_name'=>'required|max:50',
            'hidden'=>'required',
        ]);

        $product = Product::whereId($request->input('id'))->first();
        $product->SKU = $request->input('SKU');
        $product->name = $request->input('name');
        $product->short_name = $request->input('short_name');
        $product->price = $request->input('price');
        $product->fake_price = $request->input('fake_price');
        $product->hidden = $request->input('hidden');
        $product->save();
        return 'SUCCESS';
    }

    public function delete(Request $request)
    {
        $product = Product::whereId($request->input('id'))->first();
        $product->delete();
        return 'SUCCESS';
    }

    public function find(Request $request)
    {
        $sku = $request->input('sku');
        $name = $request->input('name');
        $shortname = $request->input('shortname');

        $products = Product::where('sku', 'like', '%'.$sku.'%')
            ->where('name', 'like', '%'.$name.'%')
            ->where('short_name', 'like', '%'.$shortname.'%')
            ->get();

        return $products;
    }

    public function new(Request $request)
    {
        if($request->isMethod('get')){
            return view('new-product');
        }
        $request->validate([
            'SKU'=>'required|max:50',
            'name'=>'required|max:150',
            'short_name'=>'required|max:50',
            'thumbnail'=>'mimes:jpg,bmp,png,webp|max:5120',
            'hidden'=>'required',
        ]);

        $product = new Product();
        $product->SKU = $request->input('sku');
        $product->name = $request->input('name');
        $product->short_name = $request->input('shortname');
        $product->price = $request->input('price');
        $product->fake_price = $request->input('fakeprice');
        $product->avatar_url = $request->file('thumbnail')->store('product-thumbnails', ['disk'=>'public']);
        $product->hidden = $request->input('hidden');

        $product->save();
        return redirect()->action([ManagerController::class, 'getAllProducts']);
    }
}
