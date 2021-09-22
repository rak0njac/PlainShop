<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
                'email' => $request->input('email'),
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

    public function changePassword(Request $request){
        // GET
        if($request->isMethod('get')){
            if (Auth::check()) {
                return view('change-password');
            }
            else return view('login');
        }

        // POST
        else{
//            $credentials = [
//                'email' => Auth::user()->email,
//                'password' => $request->input('old'),
//            ];
//
//            if (Auth::attempt($credentials)) {
            if (Auth::check()) {
                $new = $request->input('new');
                $newConfirm = $request->input('new-confirm');
                if($new!=$newConfirm){
                    return back()->withErrors([
                        'user' => "New password doesn't match confirm new password.",
                    ]);
                }
                $new = Hash::make($new);
                Auth::user()->password = $new;
                Auth::user()->save();
                return redirect('/admin');
                //Hash new password, find user by email, set new hashed password and return to main manager panel
            }
            else return view('login');

//            return back()->withErrors([
//                'user' => 'The provided credentials do not match our records.',
//            ]);
        }

    }
}
