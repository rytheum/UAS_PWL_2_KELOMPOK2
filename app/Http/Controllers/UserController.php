<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * READ: Menampilkan daftar resource.
     * Route: admin.user.index
     * View: resources/views/user/index.blade.php
     */
    public function index()
    {
        // Ambil semua data user, urutkan berdasarkan ID terbaru
        $users = User::latest()->get(); // Mengurutkan berdasarkan 'created_at' secara descending

        // Kembalikan view index dengan data users
        return view('admin.user.index', compact('users'));
    }

    /**
     * CREATE: Menampilkan form untuk membuat resource baru.
     * Route: admin.user.create
     * View: resources/views/user/create.blade.php
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * CREATE: Menyimpan resource yang baru dibuat ke storage.
     * Route: admin.user.store
     */
    public function store(Request $request)
    {
        // 1. Validasi Data Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => ['required', Rule::in(['admin', 'user'])], // Contoh validasi role
        ]);

        // 2. Buat User Baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password
            'role' => $request->role,
        ]);

        // 3. Redirect dengan pesan sukses
        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * READ: Menampilkan resource yang ditentukan.
     * Route: admin.user.show
     * Tidak wajib diimplementasikan untuk admin CRUD sederhana.
     */
    public function show(User $user)
    {
        // return view('user.show', compact('user'));
        return redirect()->route('admin.user.index');
    }

    /**
     * UPDATE: Menampilkan form untuk mengedit resource yang ditentukan.
     * Route: admin.user.edit
     * View: resources/views/user/edit.blade.php
     */
    public function edit(User $user)
    {
        // $user didapatkan otomatis melalui Route Model Binding
        return view('user.edit', compact('user'));
    }

    /**
     * UPDATE: Memperbarui resource yang ditentukan di storage.
     * Route: admin.user.update
     */
    public function update(Request $request, User $user)
    {
        // 1. Validasi Data Input
        $request->validate([
            'name' => 'required|string|max:255',
            // Pastikan email unik, kecuali untuk user yang sedang diedit
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed', // Password opsional saat update
            'role' => ['required', Rule::in(['admin', 'user'])],
        ]);

        // 2. Update Data
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Jika field password diisi, update juga passwordnya
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // 3. Redirect dengan pesan sukses
        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil diperbarui!');
    }

    /**
     * DELETE: Menghapus resource yang ditentukan dari storage.
     * Route: admin.user.destroy
     */
    public function destroy(User $user)
    {
        // Hindari menghapus akun sendiri
        if (auth()->user()->id == $user->id) {
            return redirect()->route('admin.user.index')
                ->with('error', 'Anda tidak bisa menghapus akun Anda sendiri!');
        }

        // Hapus User
        $user->delete();

        // 3. Redirect dengan pesan sukses
        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil dihapus!');
    }
}