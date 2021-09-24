<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function getAllOrders()
    {
        $orders = Order::all();
        return view('ordermanagement', ['orders'=>$orders]);
    }

    public function add(Request $request){
        if($request->isMethod('get')){
            return view('new-agent');
        }
        else {
            $agent = new User();
            $agent->email = $request->input("email");
            $agent->name = $request->input("name");
            $agent->username = "TEST";
            $agent->password = Hash::make("");
            $agent->type = "agent";
            $agent->password_change_required = 1;

            $agent->save();
            return redirect()->action([ManagerController::class, 'getAllAgents']);

        }
    }

    public function save(Request $request)
    {
        $agent = User::whereId($request->input('id'))->first();
        $agent->name = $request->input('name');
        $agent->email = $request->input('email');
        $agent->save();
        return 'SUCCESS';
    }

    public function delete(Request $request)
    {
        $agent = User::whereId($request->input('id'))->first();
        $agent->delete();
        return 'SUCCESS';
    }

    public function search(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');

        $agents = User::where('name', 'like', '%'.$name.'%')
            ->where('email', 'like', '%'.$email.'%')
            ->where('type', '=', 'agent')
            ->get();

        return $agents;
    }

    public function findOrder(Request $request){}
    public function addOrder(Request $request){}
    public function updateOrder(Request $request){}
}
