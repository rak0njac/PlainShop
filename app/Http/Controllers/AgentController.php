<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class AgentController extends Controller
{
    public function index(){
        return view('agent');
    }

    public function list(){
        $agents = User::whereType('agent')->get();
        return view('agentmanagement', ['agents'=>$agents]);
    }

    public function new(Request $request){
        if($request->isMethod('get')){
            return view('new-agent');
        }

        $request->validate([
            'email'=>'required|email',
            'name'=>'required|max:50',
            'password' => ['required', Password::min(8)->numbers()],
        ]);

        $agent = new User();
        $agent->email = $request->input("email");
        $agent->name = $request->input("name");
        $agent->username = "TEST";
        $agent->password = Hash::make("");
        $agent->type = "agent";
        $agent->password_change_required = 1;

        $agent->save();
        return redirect()->action([AgentController::class, 'list']);
    }

    public function update(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'name'=>'required|max:50',
        ]);

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

    public function find(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');

        $agents = User::where('name', 'like', '%'.$name.'%')
            ->where('email', 'like', '%'.$email.'%')
            ->where('type', '=', 'agent')
            ->get();

        return $agents;
    }
}
