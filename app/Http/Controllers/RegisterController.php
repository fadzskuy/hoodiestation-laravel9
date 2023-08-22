<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }
    public function index()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:255',
            'confirm_password' => 'required|same:password',
            'phone' => 'required|min:10|max:15|unique:users',
            'address' => 'required|min:5|max:255',
        ],
    [
        'name.required' => 'Nama harus di isi',
        'username.required' => 'Username harus di isi',
        'username.min' => 'Username minimal 3',
        'username.unique' => 'Username telah terpakai',
        'email.required' => 'Email harus di isi',
        'email.email' => 'Email tidak valid',
        'email.unique' => 'Email telah terdaftar',
        'password.required' => 'Password harus di isi',
        'password.min' => 'Password minimal 5',
        'confirm_password' => 'pasword harus sesuai',
        'phone.required' => 'Nomor HP harus di isi',
        'phone.min' => 'Nomor HP minimal 10',
        'phone.max' => 'Nomor HP maximal 15',
        'phone.unique' => 'Nomor HP telah terdaftar',
        'address.required' => 'Alamat harus di isi',
        'address.min' => 'Alamat minimal 5',
    ]);

        // $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
        // $request->session()->flash('success', 'Registration succesfull! Please Login');
        return redirect('/login')->with('success', 'Registrasi berhasil!');
    }
}
