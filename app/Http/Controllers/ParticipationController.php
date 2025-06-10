<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Participation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

// Import Maatwebsite\Excel jika Anda mengaktifkan fitur export
// use Maatwebsite\Excel\Facades\Excel;
// use App\Exports\ActivityParticipationsExport; // Asumsikan Anda membuat export ini

class ParticipationController extends Controller
{
    /**
     * Menampilkan daftar partisipasi (peserta & sukarelawan) untuk kegiatan tertentu.
     */
    public function index(Activity $activity)
    {
        $participations = $activity->participations()->with('user')->get();
        // Ambil daftar user yang belum jadi peserta/sukarelawan di kegiatan ini
        $usersNotParticipating = User::whereDoesntHave('participations', function ($query) use ($activity) {
            $query->where('activity_id', $activity->id);
        })->get();

        return view('admin.activities.participations.index', compact('activity', 'participations', 'usersNotParticipating'));
    }

    /**
     * Menyimpan partisipasi baru (peserta atau sukarelawan) untuk kegiatan tertentu.
     */
    public function store(Request $request, Activity $activity)
    {
        $request->validate([
            'user_id' => [
                'required',
                'exists:users,id',
                // Validasi unik untuk kombinasi user, activity, dan type (agar tidak double daftar sebagai participant DAN volunteer)
                Rule::unique('participations')->where(function ($query) use ($activity, $request) {
                    return $query->where('activity_id', $activity->id)
                                 ->where('type', $request->type);
                }),
            ],
            'type' => 'required|in:participant,volunteer',
            'status' => 'required|in:Registered,Attended,Cancelled,Assigned,Completed',
            'assigned_task' => 'nullable|string|max:255', // Hanya relevan untuk 'volunteer'
            'hours_volunteered' => 'nullable|integer|min:0', // Hanya relevan untuk 'volunteer'
            'notes' => 'nullable|string|max:1000', // Relevan untuk keduanya
        ]);

        $activity->participations()->create([
            'user_id' => $request->user_id,
            'type' => $request->type,
            'registration_date' => now(), // Otomatis mengisi tanggal pendaftaran
            'status' => $request->status,
            'assigned_task' => $request->assigned_task,
            'hours_volunteered' => $request->hours_volunteered,
            'notes' => $request->notes,
        ]);

        return redirect()->route('admin.activities.participations.index', $activity->id)->with('success', ucfirst($request->type) . ' berhasil ditambahkan!');
    }

    /**
     * Memperbarui detail partisipasi tertentu.
     */
    public function update(Request $request, Activity $activity, Participation $participation)
    {
        // Pastikan partisipasi yang diupdate memang terkait dengan kegiatan yang sedang dilihat
        if ($participation->activity_id !== $activity->id) {
            abort(404);
        }

        $request->validate([
            'status' => 'required|in:Registered,Attended,Cancelled,Assigned,Completed',
            'assigned_task' => 'nullable|string|max:255',
            'hours_volunteered' => 'nullable|integer|min:0',
            'notes' => 'nullable|string|max:1000',
        ]);

        $participation->update($request->all()); // Update semua validated fields

        return redirect()->route('admin.activities.participations.index', $activity->id)->with('success', 'Detail ' . $participation->type . ' berhasil diperbarui!');
    }

    /**
     * Menghapus partisipasi dari kegiatan tertentu.
     */
    public function destroy(Activity $activity, Participation $participation)
    {
        // Pastikan partisipasi yang dihapus memang terkait dengan kegiatan yang sedang dilihat
        if ($participation->activity_id !== $activity->id) {
            abort(404);
        }

        $participation->delete();

        return redirect()->route('admin.activities.participations.index', $activity->id)->with('success', ucfirst($participation->type) . ' berhasil dihapus!');
    }

    // Fitur Export Partisipasi (Membutuhkan Laravel Excel)
    // Jika Anda ingin mengaktifkan ini, Anda perlu:
    // 1. composer require maatwebsite/excel
    // 2. Buat export class: php artisan make:export ActivityParticipationsExport --model=Participation
    //    Di dalam ActivityParticipationsExport, sesuaikan query untuk memfilter berdasarkan activity_id
    /*
    public function export(Activity $activity)
    {
        return Excel::download(new ActivityParticipationsExport($activity->id), 'participations_' . Str::slug($activity->title) . '.xlsx');
    }
    */
}