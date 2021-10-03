<?php

namespace App\Http\Controllers;

use App\Http\Services\ProductService;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index(){
        return view('manager');
    }
}
