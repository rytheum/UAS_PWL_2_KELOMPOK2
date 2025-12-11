<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    // REGISTER CUSTOMER
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user'  // paksa jadi user
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil');
    }

    // LOGIN CUSTOMER
    public function login(Request $request)
    {
        $credentials = $request->only('email','password');

        if (Auth::attempt($credentials)) 
        {
            if (Auth::user()->role !== 'user') {
                Auth::logout();
                return back()->withErrors(['email' => 'Silakan login lewat halaman admin']);
            }

            return redirect('/customer/home');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    // LOGOUT CUSTOMER
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    // PROFILE CUSTOMER (opsional)
    public function profile()
    {
        return view('customer.profile', [
            'user' => Auth::user()
        ]);
    }

    // UPDATE PROFILE (opsional)
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
        ]);

        Auth::user()->update([
            'name' => $request->name
        ]);

        return back()->with('success','Profil berhasil diupdate');
    }
}