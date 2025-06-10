<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Activity; // Untuk konten tipe laporan yang terkait kegiatan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // Untuk slug

class ContentController extends Controller
{
    /**
     * Menampilkan daftar semua konten.
     */
    public function index()
    {
        $contents = Content::with('user')->latest()->paginate(10);
        return view('admin.contents.index', compact('contents'));
    }

    /**
     * Menampilkan form untuk membuat konten baru.
     */
    public function create()
    {
        $activities = Activity::all(); // Untuk dropdown di form
        return view('admin.contents.create', compact('activities'));
    }

    /**
     * Menyimpan konten baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:news,announcement,activity_report,financial_report,impact_report,volunteer_report,about_page,contact_page',
            'excerpt' => 'nullable|string|max:500',
            'body' => 'nullable|string',
            'file_url' => 'nullable|url|max:255',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'report_date' => 'nullable|date',
            'activity_id' => 'nullable|exists:activities,id',
        ]);

        $validatedData['user_id'] = Auth::id();

        // Logika spesifik berdasarkan tipe konten
        if (in_array($validatedData['type'], ['news', 'announcement'])) {
            $validatedData['slug'] = Str::slug($request->title);
            $validatedData['published_at'] = $request->is_published ? now() : null;
            $validatedData['report_date'] = null; // Pastikan null jika bukan laporan
            $validatedData['activity_id'] = null; // Pastikan null jika bukan laporan
        } else if (str_contains($validatedData['type'], 'report')) {
            $validatedData['slug'] = null;
            $validatedData['is_published'] = false; // Laporan biasanya tidak dipublikasi ke publik
            $validatedData['published_at'] = null;
            $validatedData['report_date'] = $request->report_date ?? now();
        } else { // Untuk halaman statis seperti About/Contact
            $validatedData['slug'] = Str::slug($request->title); // Bisa pakai slug untuk URL statis
            $validatedData['is_published'] = true; // Biasanya halaman statis langsung dipublikasi
            $validatedData['published_at'] = now();
            $validatedData['report_date'] = null;
            $validatedData['activity_id'] = null;
        }

        Content::create($validatedData);

        return redirect()->route('admin.contents.index')->with('success', 'Konten berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail satu konten.
     */
    public function show(Content $content)
    {
        return view('admin.contents.show', compact('content'));
    }

    /**
     * Menampilkan form untuk mengedit konten.
     */
    public function edit(Content $content)
    {
        $activities = Activity::all();
        return view('admin.contents.edit', compact('content', 'activities'));
    }

    /**
     * Memperbarui konten di database.
     */
    public function update(Request $request, Content $content)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:news,announcement,activity_report,financial_report,impact_report,volunteer_report,about_page,contact_page',
            'excerpt' => 'nullable|string|max:500',
            'body' => 'nullable|string',
            'file_url' => 'nullable|url|max:255',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'report_date' => 'nullable|date',
            'activity_id' => 'nullable|exists:activities,id',
        ]);

        // Logika spesifik berdasarkan tipe konten
        if (in_array($validatedData['type'], ['news', 'announcement'])) {
            $validatedData['slug'] = Str::slug($request->title);
            // Set published_at hanya jika sebelumnya null dan sekarang is_published true
            $validatedData['published_at'] = $request->is_published && !$content->published_at ? now() : $content->published_at;
            if (!$request->is_published) $validatedData['published_at'] = null; // Clear if unpublished
            $validatedData['report_date'] = null;
            $validatedData['activity_id'] = null;
        } else if (str_contains($validatedData['type'], 'report')) {
            $validatedData['slug'] = null;
            $validatedData['is_published'] = false;
            $validatedData['published_at'] = null;
            $validatedData['report_date'] = $request->report_date ?? now();
        } else { // Untuk halaman statis
            $validatedData['slug'] = Str::slug($request->title);
            $validatedData['is_published'] = true;
            $validatedData['published_at'] = $content->published_at ?? now(); // Keep current or set now
            $validatedData['report_date'] = null;
            $validatedData['activity_id'] = null;
        }

        $content->update($validatedData);

        return redirect()->route('admin.contents.index')->with('success', 'Konten berhasil diperbarui!');
    }

    /**
     * Menghapus konten dari database.
     */
    public function destroy(Content $content)
    {
        $content->delete();

        return redirect()->route('admin.contents.index')->with('success', 'Konten berhasil dihapus!');
    }
}