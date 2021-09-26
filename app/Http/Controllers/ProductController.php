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
    public function getProductView($shortname){
        $product = Product::whereShortName($shortname)->first();
        $color = $product->colors;
        $size = $product->sizes;
        $params = ['product'=>$product, 'color'=>$color, 'size'=>$size];
        if (View::exists($product->shortname)){
            return view($product->short_name, $params);
    }
        else
        return view('defaultproduct', $params);
    }

    public function deleteFromCart(Request $request)
    {
        $cartDetailId = $request->input('cookie_id');
        $cartDetail = CartDetail::whereId($cartDetailId)->first();
        $cartDetail->forceDelete();
    }

    public function cartChangeQuantity(Request $request)
    {
        $request->validate([
            'quantity'=>'required|min:1|max:99',
        ]);

        $cartDetailId = $request->input('cookie_id');
        $quantity = $request->input('quantity');
        $cartDetail = CartDetail::whereId($cartDetailId)->first();
        $cartDetail->qty = $quantity;
        $cartDetail->total_price = $cartDetail->price * $cartDetail->qty;
        $cartDetail->save();

        return $cartDetail->total_price;
    }


    public function getChangeProductThumbnailView($productid){
        $product = Product::whereId($productid)->first();
        return view('change-product-thumbnail', ['product'=>$product]);
    }

    public function getProductColorsView($productid){
        $product = Product::whereId($productid)->first();
        return view('product-colors', ['product'=>$product]);
    }

    public function getProductSizesView($productid){
        $product = Product::whereId($productid)->first();
        return view('product-sizes', ['product'=>$product]);
    }

    public function getColors($productid){
        $product = Product::whereId($productid)->first();
        return json_encode($product->colors);
    }

    public function getSizes($productid){
        $product = Product::whereId($productid)->first();
        return json_encode($product->sizes);
    }

    public function getPrice($productid){
        $product = Product::whereId($productid)->first();
        return $product->price;
    }

    public function changeProductThumbnail(Request $request)
    {
        $request->validate([
            'file'=>'mimes:jpg,bmp,png,webp|max:5120',
        ]);

        $product = Product::whereId($request->input('product'))->first();
            $file = $request->file('file')->store('product-thumbnails', ['disk'=>'public']);
            $product->avatar_url = $file;
            $product->save();
            return redirect()->action([ProductController::class, 'getChangeProductThumbnailView'], ['productid'=>$product->id]);
    }

    public function save(Request $request)
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

    public function search(Request $request)
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

    public function add(Request $request)
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

    public function addColor(Request $request)
    {
        $request->validate([
            'hex'=>'required|size:6',
        ]);

        $color = new ProductColor();
        $color->product_id = $request->input("product");
        $color->hex = $request->input("hex");
        $color->save();

        return redirect()->action([ProductController::class, 'getProductColorsView'], ['productId'=>$request->input("product")]);
    }

    public function deleteColor(Request $request)
    {
        $color = ProductColor::whereId($request->input('id'))->first();
        $color->delete();
        return 'SUCCESS';
    }

    public function addSize(Request $request)
    {
        $request->validate([
            'size'=>'required|max:20',
        ]);

        $size = new ProductSize();
        $size->product_id = $request->input("product");
        $size->name = $request->input("size");
        $size->save();

        return redirect()->action([ProductController::class, 'getProductSizesView'], ['productId'=>$request->input("product")]);
    }

    public function deleteSize(Request $request)
    {
        $size = ProductSize::whereId($request->input('id'))->first();
        $size->delete();
        return 'SUCCESS';
    }
}
