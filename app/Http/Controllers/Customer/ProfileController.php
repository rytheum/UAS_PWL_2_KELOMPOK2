<?php

namespace App\Http\Controllers\Customer;

// Karena Controller ini ada di sub-folder, kita harus import Base Controller
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();
        return view('landingpage.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            // Pastikan ignore menggunakan id_user sesuai primary key kamu
            'email' => 'required|email|unique:users,email,' . $user->id_user . ',id_user',
            'address' => 'nullable|string', 
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}