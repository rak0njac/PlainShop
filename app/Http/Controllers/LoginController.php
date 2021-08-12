<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        // GET
        if($request->isMethod('get')){
            if (Auth::check()) {
                return redirect('/');
            }
            else return view('login');
        }

        // POST
        else{
            $credentials = [
                'username' => $request->input('user'),
                'password' => $request->input('pass'),
            ];

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended();
            }

            return back()->withErrors([
                'user' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
