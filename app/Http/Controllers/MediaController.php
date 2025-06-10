<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Menampilkan daftar semua album (type='album').
     */
    public function index()
    {
        $albums = Media::where('type', 'album')->latest()->paginate(10);
        return view('admin.media.index', compact('albums'));
    }

    /**
     * Menampilkan form untuk membuat album baru.
     */
    public function create()
    {
        return view('admin.media.create');
    }

    /**
     * Menyimpan album baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail_url' => 'nullable|url|max:255', // Untuk sampul album
            'is_published' => 'boolean',
        ]);

        $validatedData['type'] = 'album'; // Set tipe sebagai album
        $validatedData['media_url'] = $validatedData['thumbnail_url']; // Untuk konsistensi, media_url album sama dengan thumbnail

        Media::create($validatedData);

        return redirect()->route('admin.media.index')->with('success', 'Album galeri berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail satu album.
     */
    public function show(Media $album)
    {
        if ($album->type !== 'album') {
            abort(404); // Pastikan yang ditampilkan memang album
        }
        $items = $album->items()->latest()->get(); // Ambil item media di dalam album
        return view('admin.media.show', compact('album', 'items'));
    }

    /**
     * Menampilkan form untuk mengedit album.
     */
    public function edit(Media $album)
    {
        if ($album->type !== 'album') {
            abort(404);
        }
        return view('admin.media.edit', compact('album'));
    }

    /**
     * Memperbarui album di database.
     */
    public function update(Request $request, Media $album)
    {
        if ($album->type !== 'album') {
            abort(404);
        }
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail_url' => 'nullable|url|max:255',
            'is_published' => 'boolean',
        ]);
        $validatedData['media_url'] = $validatedData['thumbnail_url']; // Update media_url juga

        $album->update($validatedData);

        return redirect()->route('admin.media.index')->with('success', 'Album galeri berhasil diperbarui!');
    }

    /**
     * Menghapus album dari database.
     */
    public function destroy(Media $album)
    {
        if ($album->type !== 'album') {
            abort(404);
        }
        $album->delete(); // Karena onDelete('cascade') di migrasi, item di dalamnya juga akan terhapus

        return redirect()->route('admin.media.index')->with('success', 'Album galeri berhasil dihapus!');
    }

    // --- Metode untuk Item Media (Gambar/Video) di dalam Album ---

    /**
     * Menampilkan daftar item media (gambar/video) dalam album tertentu.
     */
    public function itemsIndex(Media $album)
    {
        if ($album->type !== 'album') {
            abort(404);
        }
        $items = $album->items()->latest()->get();
        return view('admin.media.items.index', compact('album', 'items'));
    }

    /**
     * Menyimpan item media baru ke album.
     */
    public function storeItem(Request $request, Media $album)
    {
        if ($album->type !== 'album') {
            abort(404);
        }
        $request->validate([
            'media_url' => 'required|url|max:255', // Untuk saat ini masih URL, nanti bisa diubah ke file upload
            'caption' => 'nullable|string|max:255',
            'type' => 'required|in:image,video', // Tipe item media (gambar atau video)
        ]);

        $album->items()->create([ // Otomatis mengisi album_id
            'media_url' => $request->media_url,
            'caption' => $request->caption,
            'type' => $request->type,
            'is_published' => true, // Item di dalam album biasanya langsung dipublikasi
        ]);

        return back()->with('success', 'Item media berhasil ditambahkan ke album!');
    }

    /**
     * Menghapus item media dari album.
     */
    public function destroyItem(Media $album, Media $item) // $item adalah item media, bukan album
    {
        // Pastikan $item ini benar-benar item dari $album yang sesuai
        if ($item->album_id !== $album->id || !in_array($item->type, ['image', 'video'])) {
            abort(404);
        }

        $item->delete();

        return back()->with('success', 'Item media berhasil dihapus dari album!');
    }
}