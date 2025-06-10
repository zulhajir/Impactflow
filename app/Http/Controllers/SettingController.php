<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Menampilkan halaman pengaturan website.
     */
    public function index()
    {
        // Ambil semua pengaturan dan atur dengan key sebagai indeks
        $settings = Setting::all()->keyBy('key');
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Memperbarui pengaturan website.
     */
    public function update(Request $request)
    {
        $data = $request->except('_token', '_method'); // Kecualikan token CSRF dan metode HTTP

        foreach ($data as $key => $value) {
            // Update atau buat baru pengaturan, deskripsi bisa diisi manual atau dibiarkan kosong
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value ?? '', 'description' => '']
            );
        }

        return back()->with('success', 'Pengaturan berhasil diperbarui!');
    }
}