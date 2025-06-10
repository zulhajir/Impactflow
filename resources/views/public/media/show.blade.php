@extends('layouts.public')

@section('title', '| ' . $album->title)

@section('content')
    <div class="container mx-auto p-6">
        <a href="{{ route('public.media.index') }}" class="text-blue-500 hover:underline mb-6 inline-block text-lg">&larr; Kembali ke Daftar Galeri</a>

        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $album->title }}</h1>
            <p class="text-gray-600 text-sm mb-6">{{ $album->description }}</p>

            @if ($items->isEmpty())
                <p class="text-gray-600 text-center text-lg">Belum ada item media dalam album ini.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($items as $item)
                        <div class="relative group cursor-pointer" onclick="openModal('{{ $item->media_url }}', '{{ $item->caption }}')">
                            @if ($item->type == 'image')
                                <img src="{{ $item->media_url }}" alt="{{ $item->caption }}" class="w-full h-56 object-cover rounded-lg shadow-md transition-transform duration-300 transform group-hover:scale-105">
                            @elseif ($item->type == 'video')
                                <div class="w-full h-56 flex items-center justify-center bg-black text-white rounded-lg shadow-md transition-transform duration-300 transform group-hover:scale-105">
                                    Video Preview (Klik untuk lihat)
                                </div>
                                {{-- Anda bisa menyematkan video langsung dari YouTube/Vimeo di sini juga --}}
                            @endif
                            @if ($item->caption)
                                <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white p-3 rounded-b-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <p class="text-sm">{{ $item->caption }}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- Modal for image/video preview --}}
    <div id="mediaModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="relative bg-white p-4 rounded-lg max-w-3xl max-h-full overflow-auto">
            <button class="absolute top-2 right-2 text-gray-800 bg-white rounded-full p-1 text-2xl font-bold" onclick="closeModal()">&times;</button>
            <img id="modalImage" src="" alt="" class="max-w-full max-h-[80vh] object-contain mx-auto hidden">
            <iframe id="modalVideo" src="" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen class="max-w-full max-h-[80vh] mx-auto hidden w-[560px] h-[315px]"></iframe>
            <p id="modalCaption" class="text-center text-gray-700 mt-2"></p>
        </div>
    </div>

    @push('scripts')
    <script>
        const mediaModal = document.getElementById('mediaModal');
        const modalImage = document.getElementById('modalImage');
        const modalVideo = document.getElementById('modalVideo');
        const modalCaption = document.getElementById('modalCaption');

        function openModal(mediaUrl, caption) {
            modalImage.classList.add('hidden');
            modalVideo.classList.add('hidden');
            modalVideo.src = ''; // Clear previous video

            if (mediaUrl.includes('youtube.com') || mediaUrl.includes('youtu.be')) {
                // Example for YouTube embed URL (you might need to adjust based on exact URL structure)
                const videoId = mediaUrl.split('v=')[1] || mediaUrl.split('/').pop();
                modalVideo.src = `https://www.youtube.com/embed/${videoId}`;
                modalVideo.classList.remove('hidden');
                modalVideo.style.display = 'block'; // Ensure it's block for iframe
            } else {
                modalImage.src = mediaUrl;
                modalImage.classList.remove('hidden');
            }

            modalCaption.textContent = caption;
            mediaModal.classList.remove('hidden');
        }

        function closeModal() {
            mediaModal.classList.add('hidden');
            modalImage.src = '';
            modalVideo.src = '';
            modalCaption.textContent = '';
        }

        mediaModal.addEventListener('click', function(event) {
            if (event.target === mediaModal) {
                closeModal();
            }
        });
    </script>
    @endpush
@endsection