<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Testing\Fluent\Concerns\Has;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // GET
        if ($request->isMethod('get')) {
            if (Auth::check()) {
                if (Auth::user()->type == 'admin')
                    return redirect('/admin');
                return redirect('/agent');
            } else return view('login');
        }

        // POST
        else {
            $email = $request->input('email');
            $pass = $request->input('pass');

            $credentials = [
                'email' => $email,
                'password' => $pass,
            ];


            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                if ($user->password_change_required) {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return view('set-first-password', ['agent' => $user]);
                }
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

    public function changePassword(Request $request)
    {
        // GET
        if ($request->isMethod('get')) {
            if (Auth::check()) {
                return view('change-password');
            } else return view('login');
        }

        // POST
        else {
            if (Auth::check()) {
                $oldPass = $request->input('old');
//                Log::info("Auth::user()->password is ".Auth::user()->password);
//                Log::info("Hash::make($oldPass) is ".Hash::make($oldPass));
                if (!(Hash::check($oldPass, Auth::user()->password))) {
                    return back()->withErrors([
                        'user' => "The old (current) password you entered doesn't match your actual current password.",
                    ]);
                }
                $newPass = $request->input('new');
                $confirmNewPass = $request->input('new-confirm');
                if ($newPass != $confirmNewPass) {
                    return back()->withErrors([
                        'user' => "New password doesn't match confirm new password.",
                    ]);
                }
                $newPass = Hash::make($newPass);
                Auth::user()->password = $newPass;
                Auth::user()->save();
                return redirect('/login');
                //Hash new password, find user by email, set new hashed password and return to main manager panel
            }
            return redirect('/login');
        }
    }

    public function setFirstPassword(Request $request)
    {
        $agent = User::whereId($request->input('agent'))->first();
        if($agent->password_change_required){
            $newPass = $request->input('new');
            $newPassConfirm = $request->input('new-confirm');
            if ($newPass != $newPassConfirm) {
                return back()->withErrors([
                    'user' => "New password doesn't match confirm new password.",
                ]);
            }
            $newPass = Hash::make($newPass);
            $agent->password = $newPass;
            $agent->password_change_required = 0;
            $agent->save();

            $credentials = [
                'email' => $agent->email,
                'password' => $newPass,
            ];

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect('/login');
            }
        }
        return redirect('/login');
    }
}
