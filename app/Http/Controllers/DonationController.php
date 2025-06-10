<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Http\Request;

// Import Maatwebsite\Excel jika Anda mengaktifkan fitur export
// use Maatwebsite\Excel\Facades\Excel;
// use App\Exports\DonationsExport; // Asumsikan Anda membuat export ini

class DonationController extends Controller
{
    /**
     * Menampilkan daftar semua donasi.
     */
    public function index()
    {
        $donations = Donation::with(['user', 'activity'])->latest()->paginate(10);
        return view('admin.donations.index', compact('donations'));
    }

    /**
     * Menampilkan form untuk membuat donasi baru.
     */
    public function create()
    {
        $users = User::all();
        $activities = Activity::all();
        return view('admin.donations.create', compact('users', 'activities'));
    }

    /**
     * Menyimpan donasi baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'activity_id' => 'nullable|exists:activities,id',
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'required|string|size:3',
            'donation_date' => 'required|date',
            'payment_method' => 'required|string|max:255',
            'is_anonymous' => 'boolean',
            'status' => 'required|in:Pending,Completed,Failed',
        ]);

        // Logika untuk is_anonymous jika user_id tidak diisi
        if (empty($validatedData['user_id'])) {
            $validatedData['is_anonymous'] = true;
        } else {
            $validatedData['is_anonymous'] = $request->has('is_anonymous'); // Pastikan checkbox juga di-handle
        }

        Donation::create($validatedData);

        return redirect()->route('admin.donations.index')->with('success', 'Donasi berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail satu donasi.
     */
    public function show(Donation $donation)
    {
        return view('admin.donations.show', compact('donation'));
    }

    /**
     * Menampilkan form untuk mengedit donasi.
     */
    public function edit(Donation $donation)
    {
        $users = User::all();
        $activities = Activity::all();
        return view('admin.donations.edit', compact('donation', 'users', 'activities'));
    }

    /**
     * Memperbarui donasi di database.
     */
    public function update(Request $request, Donation $donation)
    {
        $validatedData = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'activity_id' => 'nullable|exists:activities,id',
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'required|string|size:3',
            'donation_date' => 'required|date',
            'payment_method' => 'required|string|max:255',
            'is_anonymous' => 'boolean',
            'status' => 'required|in:Pending,Completed,Failed',
        ]);

        // Logika untuk is_anonymous jika user_id tidak diisi
        if (empty($validatedData['user_id'])) {
            $validatedData['is_anonymous'] = true;
        } else {
            $validatedData['is_anonymous'] = $request->has('is_anonymous');
        }

        $donation->update($validatedData);

        return redirect()->route('admin.donations.index')->with('success', 'Donasi berhasil diperbarui!');
    }

    /**
     * Menghapus donasi dari database.
     */
    public function destroy(Donation $donation)
    {
        $donation->delete();

        return redirect()->route('admin.donations.index')->with('success', 'Donasi berhasil dihapus!');
    }

    // Fitur Export Donasi (Membutuhkan Laravel Excel)
    // Jika Anda ingin mengaktifkan ini, Anda perlu:
    // 1. composer require maatwebsite/excel
    // 2. php artisan make:export DonationsExport --model=Donation
    public function export()
    {
        // return Excel::download(new DonationsExport, 'donations.xlsx');

        return back()->with('info', 'Fitur ekspor data donasi belum diaktifkan atau dikonfigurasi sepenuhnya. Silakan lihat komentar di kode.');
    }
}