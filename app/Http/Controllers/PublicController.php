<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Participation;
use App\Models\Donation;
use App\Models\Content;
use App\Models\Media;
use App\Models\User; // Digunakan jika donasi anonim tanpa login membuat user
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PublicController extends Controller
{
    public function welcome() { return view('public.welcome'); }

    public function activities()
    {
        $activities = Activity::whereIn('status', ['Planned', 'Ongoing'])->latest()->paginate(9);
        return view('public.activities.index', compact('activities'));
    }

    public function showActivity(Activity $activity)
    {
        if (!in_array($activity->status, ['Planned', 'Ongoing'])) {
            abort(404, 'Kegiatan tidak ditemukan atau tidak tersedia.');
        }
        $isParticipant = Auth::check() ? $activity->participations()->where('user_id', Auth::id())->where('type', 'participant')->exists() : false;
        $isVolunteer = Auth::check() ? $activity->participations()->where('user_id', Auth::id())->where('type', 'volunteer')->exists() : false;

        return view('public.activities.show', compact('activity', 'isParticipant', 'isVolunteer'));
    }

    public function registerParticipation(Request $request, Activity $activity, $type) // $type bisa 'participant' atau 'volunteer'
    {
        if (!in_array($activity->status, ['Planned', 'Ongoing'])) {
            return back()->with('error', 'Pendaftaran tidak tersedia untuk kegiatan ini.');
        }
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda perlu login untuk mendaftar sebagai ' . $type . '.');
        }

        $exists = Participation::where('user_id', Auth::id())
                               ->where('activity_id', $activity->id)
                               ->where('type', $type)
                               ->exists();
        if ($exists) {
            return back()->with('error', 'Anda sudah terdaftar sebagai ' . $type . ' untuk kegiatan ini.');
        }

        Participation::create([
            'user_id' => Auth::id(),
            'activity_id' => $activity->id,
            'type' => $type,
            'registration_date' => now(),
            'status' => 'Registered', // Status awal
        ]);

        return back()->with('success', 'Anda berhasil mendaftar sebagai ' . $type . ' untuk kegiatan "' . $activity->title . '"!');
    }

    public function cancelParticipation(Request $request, Activity $activity, $type)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda perlu login untuk membatalkan pendaftaran.');
        }
        $participation = Participation::where('user_id', Auth::id())
                                      ->where('activity_id', $activity->id)
                                      ->where('type', $type)
                                      ->first();
        if ($participation) {
            $participation->delete();
            return back()->with('success', 'Pendaftaran ' . $type . ' Anda untuk kegiatan "' . $activity->title . '" berhasil dibatalkan.');
        }
        return back()->with('error', 'Anda tidak terdaftar sebagai ' . $type . ' untuk kegiatan ini.');
    }

    public function contentsIndex($type = 'news')
    {
        $contents = Content::where('type', $type)
                           ->where('is_published', true)
                           ->latest()
                           ->paginate(9);
        return view('public.contents.index', compact('contents', 'type'));
    }

    public function showContent(Content $content)
    {
        if (!$content->is_published) { abort(404); }
        return view('public.contents.show', compact('content'));
    }

    public function mediaIndex()
    {
        $albums = Media::where('type', 'album')
                       ->where('is_published', true)
                       ->latest()
                       ->paginate(9);
        return view('public.media.index', compact('albums'));
    }

    public function showMedia(Media $album)
    {
        if ($album->type !== 'album' || !$album->is_published) { abort(404); }
        $items = $album->items()->where('is_published', true)->get();
        return view('public.media.show', compact('album', 'items'));
    }

    public function donationPage()
    {
        $activities = Activity::whereIn('status', ['Planned', 'Ongoing'])->get();
        return view('public.donation-page', compact('activities'));
    }

// ... (metode-metode lain) ...

public function submitDonation(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255',
        'amount' => 'required|numeric|min:10000',
        'payment_method' => 'required|string|max:255',
        'activity_id' => 'nullable|exists:activities,id',
        'is_anonymous' => 'boolean',
    ]);

    $userId = Auth::id();
    $isAnonymous = $request->has('is_anonymous');

    if (!$isAnonymous && !$userId) {
        // Jika tidak anonim tapi tidak login, kita bisa minta mereka login/register
        // Atau, jika Anda tetap ingin mereka bisa donasi tanpa login tapi tidak anonim,
        // Anda harus memutuskan bagaimana mengelola data mereka tanpa membuat user baru
        // Untuk skenario 'admin' dan 'user' saja, lebih baik minta login atau anonim.
        return back()->with('error', 'Anda harus login untuk berdonasi dengan nama, atau pilih donasi anonim.');
    }

    Donation::create([
        'user_id' => $userId, // Akan null jika anonim dan tidak login
        'activity_id' => $validatedData['activity_id'],
        'amount' => $validatedData['amount'],
        'currency' => 'IDR',
        'donation_date' => now(),
        'payment_method' => $validatedData['payment_method'],
        'is_anonymous' => $isAnonymous,
        'status' => 'Pending',
    ]);

    return back()->with('success', 'Terima kasih atas donasi Anda! Pembayaran Anda sedang diproses.');
}
}