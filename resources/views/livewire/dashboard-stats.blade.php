<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    {{-- Kartu: Total Karyawan --}}
    <div class="bg-gray-800/50 ring-1 ring-white/10 rounded-lg p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-indigo-500/10 ring-1 ring-inset ring-indigo-500/20">
                <x-heroicon-o-users class="h-6 w-6 text-indigo-400" />
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-400">Total Karyawan</p>
                <p class="text-2xl font-semibold text-white">{{ $totalKaryawan }}</p>
            </div>
        </div>
    </div>

    {{-- Kartu: Karyawan Tetap --}}
    <div class="bg-gray-800/50 ring-1 ring-white/10 rounded-lg p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-500/10 ring-1 ring-inset ring-green-500/20">
                <x-heroicon-o-shield-check class="h-6 w-6 text-green-400" />
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-400">Karyawan Tetap</p>
                <p class="text-2xl font-semibold text-white">{{ $karyawanTetap }}</p>
            </div>
        </div>
    </div>

    {{-- Kartu: Karyawan Kontrak --}}
    <div class="bg-gray-800/50 ring-1 ring-white/10 rounded-lg p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-500/10 ring-1 ring-inset ring-yellow-500/20">
                <x-heroicon-o-document-text class="h-6 w-6 text-yellow-400" />
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-400">Karyawan Kontrak</p>
                <p class="text-2xl font-semibold text-white">{{ $karyawanKontrak }}</p>
            </div>
        </div>
    </div>
    
    {{-- Kartu: Karyawan Magang --}}
    <div class="bg-gray-800/50 ring-1 ring-white/10 rounded-lg p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-500/10 ring-1 ring-inset ring-blue-500/20">
                <x-heroicon-o-academic-cap class="h-6 w-6 text-blue-400" />
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-400">Karyawan Magang</p>
                <p class="text-2xl font-semibold text-white">{{ $karyawanMagang }}</p>
            </div>
        </div>
    </div>

    {{-- Kartu: Distribusi per Lokasi (lebih besar) --}}
    <div class="md:col-span-2 lg:col-span-4 bg-gray-800/50 ring-1 ring-white/10 rounded-lg p-6">
        <h3 class="text-base font-medium text-white">Distribusi per Lokasi</h3>
        <ul class="mt-4 space-y-3">
            @forelse($distribusiLokasi as $lokasi)
                <li class="flex justify-between items-center text-sm">
                    <span class="text-gray-400">{{ $lokasi->nama_lokasi }}</span>
                    <span class="font-semibold text-white">{{ $lokasi->total }} Karyawan</span>
                </li>
            @empty
                <li class="text-sm text-center text-gray-500">Belum ada data lokasi.</li>
            @endforelse
        </ul>
    </div>
</div>