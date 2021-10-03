<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Session;

class CartController extends Controller
{
    public function index()
    {
        if(!Cookie::has('cart'))
        {
            return back()->withErrors([
                'error' => "Cookie not set. If you didn't access this page manually by URL, contact webmaster.",
            ]);
        }
        $cartId =  Cookie::get('cart');
        $cart = Cart::whereId($cartId)->first();

        return view('cart', ['cart'=>$cart]);
    }

    public function update(Request $request){
        if(!Cookie::has('cart'))
        {
            $cart = new Cart();
            $cart->save();
            Cookie::queue('cart', $cart->id, 60*60*24*7);
        }
        else {
            $cartId =  Cookie::get('cart');
            //Log::info('Cart id extracted from cookie:'.print_r($cartId));
            $cart = Cart::whereId($cartId)->first();
        }

        $request->validate([
            'product'=>'required',
            'quantity'=>'required|min:1|max:99',
        ]);

        $product = Product::whereId($request->input('product'))->first();
        $color = ProductColor::whereId($request->input('color'))->first();
        $size = ProductSize::whereId($request->input('size'))->first();

        $quantity = $request->input('quantity');
        $price = $request->input('price');
        $totalPrice = $quantity * $price;

        $check = false;     //Check if we will just be increasing quantity for a product already in cart, or adding a new product to the cart

        foreach($cart->details as $detail)
        {
            //Log::info('Entered foreach loop');
            if ($detail->product == $product && $detail->productColor == $color && $detail->productSize == $size){
                //Log::info('Entered if loop');
                $detail->qty += $quantity;
                $detail->price = $price;
                $detail->total_price = $detail->qty * $detail->price;
                $detail->save();
                $check = true;
            }
        }

        if(!$check)
        {
            //Log::info('Check is false');
            $detail = new CartDetail();
            $detail->cart_id = $cart->id;
            $detail->product_id = $product->id;
            $detail->qty = $quantity;
            $detail->price = $price;
            $detail->product_color_id = optional($color)->id;
            $detail->product_size_id = optional($size)->id;
            $detail->total_price = $totalPrice;
            $detail->save();
        }
        return redirect()->action([CartController::class, 'index']);
    }

    public function changeDetailQuantity(Request $request){
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

    public function deleteDetail(Request $request){
        $cartDetailId = $request->input('cookie_id');
        $cartDetail = CartDetail::whereId($cartDetailId)->first();
        $cartDetail->forceDelete();
    }
}
