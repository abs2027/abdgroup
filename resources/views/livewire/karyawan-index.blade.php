<div>
    {{-- [BARU] Wadah untuk semua filter --}}
    {{-- Wadah untuk semua filter --}}
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-4">
        {{-- Kotak Pencarian --}}
        <div>
            <input 
                type="search" 
                wire:model.live.debounce.300ms="search" 
                placeholder="Cari berdasarkan nama atau NIK..."
                class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6"
            >
        </div>

        {{-- Dropdown Filter Lokasi --}}
        <div>
            <select wire:model.live="filterLokasi" class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
                <option value="">Semua Lokasi</option>
                @foreach($semua_lokasi as $lokasi)
                    <option value="{{ $lokasi->id }}">{{ $lokasi->nama_lokasi }}</option>
                @endforeach
            </select>
        </div>

        {{-- Dropdown Filter Jabatan --}}
        <div>
            <select wire:model.live="filterJabatan" class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
                <option value="">Semua Jabatan</option>
                @foreach($semua_jabatan as $jabatan)
                    <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
                @endforeach
            </select>
        </div>

        {{-- [TAMBAHKAN INI] Dropdown Filter Status --}}
        <div>
            <select wire:model.live="filterStatus" class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
                <option value="">Semua Status</option>
                <option value="Tetap">Tetap</option>
                <option value="Kontrak">Kontrak</option>
                <option value="Magang">Magang</option>
            </select>
        </div>
    </div>

    {{-- Tabel Bergaya Filament --}}
    <div class="overflow-hidden rounded-lg border border-gray-700 shadow-sm">
        {{-- ... (Isi <table> Anda tetap sama persis seperti sebelumnya) ... --}}
        <table class="min-w-full divide-y divide-gray-700">
            <thead class="bg-gray-800">
                <tr>
                    <th scope="col" wire:click="setSortBy('nama_panjang')" class="cursor-pointer px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-400 hover:text-gray-200">
                        <div class="flex items-center gap-x-2">
                            <span>Nama Karyawan</span>
                            @if($sortBy === 'nama_panjang')
                                @if($sortDir === 'ASC')
                                    <x-heroicon-s-chevron-up class="h-4 w-4" />
                                @else
                                    <x-heroicon-s-chevron-down class="h-4 w-4" />
                                @endif
                            @else
                                <x-heroicon-s-chevron-up-down class="h-4 w-4 text-gray-600" />
                            @endif
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-400">
                        Jabatan & Lokasi
                    </th>
                    <th scope="col" wire:click="setSortBy('status_karyawan')" class="cursor-pointer px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-400 hover:text-gray-200">
                        <div class="flex items-center gap-x-2">
                            <span>Status</span>
                             @if($sortBy === 'status_karyawan')
                                @if($sortDir === 'ASC')
                                    <x-heroicon-s-chevron-up class="h-4 w-4" />
                                @else
                                    <x-heroicon-s-chevron-down class="h-4 w-4" />
                                @endif
                            @else
                                <x-heroicon-s-chevron-up-down class="h-4 w-4 text-gray-600" />
                            @endif
                        </div>
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Aksi</span>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800 bg-gray-900">
                @forelse($karyawans as $karyawan)
                <tr class="hover:bg-gray-800/五十">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                        {{ $karyawan->nama_panjang }}
                        <span class="block mt-1 text-xs text-gray-400 font-normal">{{ $karyawan->nomer_induk_karyawan }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                        {{ $karyawan->jabatanPosisi->nama_jabatan ?? 'N/A' }}
                        <span class="block mt-1 text-xs text-gray-500">{{ $karyawan->lokasiPenempatan->nama_lokasi ?? 'N/A' }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <span @class([
                            'inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset',
                            'bg-green-500/10 text-green-400 ring-green-500/20' => $karyawan->status_karyawan === 'Tetap',
                            'bg-yellow-500/10 text-yellow-400 ring-yellow-500/20' => $karyawan->status_karyawan === 'Kontrak',
                            'bg-blue-500/10 text-blue-400 ring-blue-500/20' => $karyawan->status_karyawan === 'Magang',
                        ])>
                            {{ $karyawan->status_karyawan }}
                        </span>
                    </td>
                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                        @if ($karyawan->user_id)
                            <span class="text-xs text-green-400">Akun Terhubung</span>
                        @else
                            <button wire:click="buatAkunLogin({{ $karyawan->id }})" class="font-semibold text-cyan-400 hover:text-cyan-300">
                                Buat Akun
                            </button>
                        @endif

                        <a href="{{ route('karyawan.edit', $karyawan) }}" wire:navigate class="ml-4 font-semibold text-indigo-400 hover:text-indigo-300">Edit</a>
                        <button wire:click="deleteKaryawan({{ $karyawan->id }})" ... class="ml-4 ...">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-sm text-gray-500">
                        Tidak ada data karyawan yang cocok dengan filter Anda.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    {{-- Informasi dan Link Pagination --}}
    <div class="mt-6 flex items-center justify-between">
        <div class="text-sm text-gray-400">
            Menampilkan {{ $karyawans->firstItem() }} sampai {{ $karyawans->lastItem() }} dari {{ $karyawans->total() }} hasil
        </div>
        {{ $karyawans->links() }}
    </div>
</div>