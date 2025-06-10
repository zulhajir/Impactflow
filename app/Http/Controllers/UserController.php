<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Menampilkan detail satu pengguna.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Menampilkan form untuk mengedit pengguna.
     */
    public function edit(User $user)
    {
        // Daftar role yang bisa dipilih hanya 'admin' dan 'user'
        $roles = ['admin', 'user'];
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Memperbarui detail pengguna di database.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'role' => 'required|in:admin,user', // Validasi role hanya 'admin' atau 'user'
        ]);

        $user->update($validatedData);

        return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    /**
     * Menghapus pengguna dari database.
     */
    public function destroy(User $user)
    {
        // Pastikan admin tidak menghapus dirinya sendiri
        if (Auth::id() === $user->id) {
            return back()->with('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus!');
    }

    /**
     * Mengubah role pengguna tertentu.
     */
    public function changeRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,user', // Validasi role hanya 'admin' atau 'user'
        ]);

        // Pastikan admin tidak mengubah role dirinya sendiri melalui metode ini
        if (Auth::id() === $user->id && $request->role !== $user->role) {
            return back()->with('error', 'Anda tidak bisa mengubah role Anda sendiri melalui cara ini.');
        }

        $user->update(['role' => $request->role]);

        return back()->with('success', 'Role pengguna berhasil diubah!');
    }
}