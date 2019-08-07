<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(array('email' => $email, 'password' => $password, 'status' => 'active'))) {
            return redirect('/admin');

        } else {
            return redirect()->route('login')->with(['failed' => 'Email hoặc mật khẩu không chính xác!']);
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
