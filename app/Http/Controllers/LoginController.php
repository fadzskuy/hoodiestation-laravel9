<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }
    public function index()
    {
        return view('auth.login', [
            'title' => 'Hoodie Station'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5'
        ],
    [
        'email.required' => 'Email Harus di isi',
        'password.required' => 'Password harus di isi',
        'password.min' => 'Password minimal 5',
    ]);
        // if(Auth::attempt($credentials)){
        //     $request->session()->regenerate();
        //     return redirect()->intended('/home');
        // }

        if (Auth::guard('admin')->attempt($credentials)){
            return redirect('/produk');
        }elseif(Auth::guard('user')->attempt($credentials)){
            return redirect('/home');
        }
        return back()->with('loginError', 'Login Gagal');

    }
    public function logout(){
        if (Auth::guard('user')->check()){
            Auth::guard('user')->logout();
        }elseif (Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
        }
        return redirect('/');
    }
}
