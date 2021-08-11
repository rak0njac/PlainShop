<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function getAllAgents()
    {
        $agents = User::whereType('agent')->get();
        return view('agentmanagement', ['agents'=>$agents]);
    }
}
