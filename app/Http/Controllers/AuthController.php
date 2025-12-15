<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * LOGIN
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return back()
                ->with('login_error', 'Email atau Password salah!')
                ->withInput()
                ->with('show', 'login');
        }

        $request->session()->regenerate();

        // 🔥 INI KUNCI JAWABANMU
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // selain admin
        return redirect()->route('landing');
    }

    /**
     * REGISTER (CONFIRMED)
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'customer',
        ]);

        return redirect()
            ->route('auth')
            ->with('success', 'Register berhasil! Silakan login.')
            ->with('show', 'login');
    }

    /**
     * LOGOUT
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth');
    }
}
