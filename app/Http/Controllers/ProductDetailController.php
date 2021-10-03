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

class ProductDetailController extends Controller
{
    public function getDetails($productid){
        $product = Product::whereId($productid)->first();
        return json_encode([$product->colors, $product->sizes, $product->price]);
    }

    public function showSizes($productid){
        $product = Product::whereId($productid)->first();
        return view('product-sizes', ['product'=>$product]);
    }

    public function showColors($productid){
        $product = Product::whereId($productid)->first();
        return view('product-colors', ['product'=>$product]);
    }

    public function newColor(Request $request)
    {
        $request->validate([
            'hex'=>'required|size:6',
        ]);

        $color = new ProductColor();
        $color->product_id = $request->input("product");
        $color->hex = $request->input("hex");
        $color->save();

        return redirect()->action([ProductDetailController::class, 'getProductColorsView'], ['productId'=>$request->input("product")]);
    }

    public function deleteColor(Request $request)
    {
        $color = ProductColor::whereId($request->input('id'))->first();
        $color->delete();
        return 'SUCCESS';
    }

    public function newSize(Request $request)
    {
        $request->validate([
            'size'=>'required|max:20',
        ]);

        $size = new ProductSize();
        $size->product_id = $request->input("product");
        $size->name = $request->input("size");
        $size->save();

        return redirect()->action([ProductDetailController::class, 'showSizes'], ['productId'=>$request->input("product")]);
    }

    public function deleteSize(Request $request)
    {
        $size = ProductSize::whereId($request->input('id'))->first();
        $size->delete();
        return 'SUCCESS';
    }
}
