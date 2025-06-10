<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // Tambahkan ini untuk slug di export (jika digunakan)

// Import Maatwebsite\Excel jika Anda mengaktifkan fitur export
// use Maatwebsite\Excel\Facades\Excel;
// use App\Exports\ActivityParticipationsExport; // Asumsikan Anda membuat export ini

class ActivityController extends Controller
{
    /**
     * Menampilkan daftar semua kegiatan untuk Admin.
     */
    public function index()
    {
        $activities = Activity::latest()->paginate(10);
        return view('admin.activities.index', compact('activities'));
    }

    /**
     * Menampilkan form untuk membuat kegiatan baru.
     */
    public function create()
    {
        return view('admin.activities.create');
    }

    /**
     * Menyimpan kegiatan baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'target_participants' => 'nullable|integer|min:1',
            'status' => 'required|in:Planned,Ongoing,Completed,Cancelled',
            'required_funds' => 'nullable|numeric|min:0',
            'image_url' => 'nullable|url|max:255',
        ]);

        $validatedData['user_id'] = Auth::id(); // Kegiatan dibuat oleh user yang sedang login

        Activity::create($validatedData);

        return redirect()->route('admin.activities.index')->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail satu kegiatan.
     */
    public function show(Activity $activity)
    {
        return view('admin.activities.show', compact('activity'));
    }

    /**
     * Menampilkan form untuk mengedit kegiatan.
     */
    public function edit(Activity $activity)
    {
        return view('admin.activities.edit', compact('activity'));
    }

    /**
     * Memperbarui kegiatan di database.
     */
    public function update(Request $request, Activity $activity)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'target_participants' => 'nullable|integer|min:1',
            'status' => 'required|in:Planned,Ongoing,Completed,Cancelled',
            'required_funds' => 'nullable|numeric|min:0',
            'image_url' => 'nullable|url|max:255',
        ]);

        $activity->update($validatedData);

        return redirect()->route('admin.activities.index')->with('success', 'Kegiatan berhasil diperbarui!');
    }

    /**
     * Menghapus kegiatan dari database.
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect()->route('admin.activities.index')->with('success', 'Kegiatan berhasil dihapus!');
    }

    // Fitur Export Partisipasi (Membutuhkan Laravel Excel)
    // Jika Anda ingin mengaktifkan ini, Anda perlu:
    // 1. composer require maatwebsite/excel
    // 2. php artisan make:export ActivityParticipationsExport --model=Participation
    // 3. Edit ActivityParticipationsExport.php untuk memfilter berdasarkan activity_id
    public function exportParticipants(Activity $activity)
    {
        // Contoh implementasi jika sudah ada Maatwebsite\Excel dan ActivityParticipationsExport
        // return Excel::download(new ActivityParticipationsExport($activity->id), 'participations_' . Str::slug($activity->title) . '.xlsx');

        return back()->with('info', 'Fitur ekspor data partisipasi belum diaktifkan atau dikonfigurasi sepenuhnya. Silakan lihat komentar di kode.');
    }
}