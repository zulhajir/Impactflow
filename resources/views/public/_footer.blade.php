<footer class="bg-gray-800 text-white py-8 mt-12">
    <div class="container mx-auto px-6">
        <div class="flex flex-wrap justify-between items-center">
            <div class="w-full md:w-1/3 text-center md:text-left mb-6 md:mb-0">
                <h3 class="text-2xl font-bold mb-2">ImpactFlow</h3>
                <p class="text-gray-400 text-sm">Platform manajemen kegiatan sosial Anda.</p>
            </div>
            <div class="w-full md:w-1/3 text-center mb-6 md:mb-0">
                <h4 class="text-lg font-semibold mb-3">Tautan Cepat</h4>
                <ul class="text-gray-400 text-sm">
                    <li><a href="{{ route('public.activities.index') }}" class="hover:text-white transition-colors duration-300">Kegiatan</a></li>
                    <li><a href="{{ route('public.contents.index') }}" class="hover:text-white transition-colors duration-300">Berita</a></li>
                    <li><a href="{{ route('public.media.index') }}" class="hover:text-white transition-colors duration-300">Galeri</a></li>
                    <li><a href="{{ route('public.donations.page') }}" class="hover:text-white transition-colors duration-300">Donasi</a></li>
                </ul>
            </div>
            <div class="w-full md:w-1/3 text-center md:text-right">
                <h4 class="text-lg font-semibold mb-3">Kontak Kami</h4>
                <ul class="text-gray-400 text-sm">
                    <li>Email: info@impactflow.org</li>
                    <li>Telepon: +62 812 3456 7890</li>
                    <li>Alamat: Jl. Karanjalemba No. 08, Kota Palu</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-700 mt-8 pt-4 text-center text-gray-500 text-xs">
            &copy; {{ date('Y') }} ImpactFlow. All rights reserved.
        </div>
    </div>
</footer>