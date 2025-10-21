<div>
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
        {{-- Dropdown Filter Status --}}
        <div>
            <select wire:model.live="filterStatus" class="block w-full rounded-md border-0 bg-white/5 py-1.5 text-white shadow-sm ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6">
                <option value="">Semua Status</option>
                <option value="Tetap">Tetap</option>
                <option value="Kontrak">Kontrak</option>
                <option value="Magang">Magang</option>
            </select>
        </div>
    </div>

    {{-- [BARU] Menu Aksi Massal, muncul saat ada item dipilih --}}
    @if ($selectedKaryawans)
    <div class="mb-4 flex items-center gap-x-4 bg-gray-800/50 ring-1 ring-white/10 rounded-lg p-3">
        <span class="text-sm font-medium text-white">{{ count($selectedKaryawans) }} item dipilih</span>
        
        <button 
            wire:click="deleteSelected"
            wire:confirm="Anda yakin ingin menghapus semua data yang dipilih?"
            class="rounded-md bg-red-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500"
        >
            Hapus yang Dipilih
        </button>
    </div>
    @endif

    {{-- Tabel dengan Checkbox --}}
    <div class="overflow-hidden rounded-lg border border-gray-700 shadow-sm">
        <table class="min-w-full divide-y divide-gray-700">
            <thead class="bg-gray-800">
                <tr>
                    {{-- [BARU] Checkbox Header --}}
                    <th scope="col" class="relative px-7 sm:w-12 sm:px-6">
                        <input type="checkbox" wire:model.live="selectAll" class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-600 bg-gray-800 text-indigo-600 focus:ring-indigo-600">
                    </th>
                    <th scope="col" wire:click="setSortBy('nama_panjang')" class="cursor-pointer px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-400 hover:text-gray-200">
                        <div class="flex items-center gap-x-2">
                            <span>Nama Karyawan</span>
                            @if($sortBy === 'nama_panjang')
                                @if($sortDir === 'ASC') <x-heroicon-s-chevron-up class="h-4 w-4" /> @else <x-heroicon-s-chevron-down class="h-4 w-4" /> @endif
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
                                @if($sortDir === 'ASC') <x-heroicon-s-chevron-up class="h-4 w-4" /> @else <x-heroicon-s-chevron-down class="h-4 w-4" /> @endif
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
                <tr wire:key="{{ $karyawan->id }}" class="hover:bg-gray-800/50">
                    {{-- [BARU] Checkbox Baris --}}
                    <td class="relative px-7 sm:w-12 sm:px-6">
                        <div class="absolute inset-y-0 left-0 w-0.5 bg-indigo-600" style="display: {{ in_array($karyawan->id, $selectedKaryawans) ? 'block' : 'none' }};"></div>
                        <input type="checkbox" wire:model.live="selectedKaryawans" value="{{ $karyawan->id }}" class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-600 bg-gray-800 text-indigo-600 focus:ring-indigo-600">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                        {{ $karyawan->nama_panjang }}
                        <span class="block mt-1 text-xs text-gray-400 font-normal">{{ $karyawan->nomer_induk_karyawan }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                        {{ $karyawan->jabatanPosisi->nama_jabatan ?? 'N/A' }}
                        <span class="block mt-1 text-xs text-gray-500">{{ $karyawan->lokasiPenempatan->nama_lokasi ?? 'N/A' }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <span @class(['...'])>
                            {{-- ... badge status ... --}}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        @if ($karyawan->user_id)
                            <span class="text-xs text-green-400 mr-4">Akun Terhubung</span>
                        @else
                            <button wire:click="buatAkunLogin({{ $karyawan->id }})" class="font-semibold text-cyan-400 hover:text-cyan-300 mr-4">
                                Buat Akun
                            </button>
                        @endif
                        <a href="{{ route('karyawan.edit', $karyawan) }}" wire:navigate class="font-semibold text-indigo-400 hover:text-indigo-300">Edit</a>
                        <button wire:click="deleteKaryawan({{ $karyawan->id }})" wire:confirm="Anda yakin ingin menghapus data ini?" class="ml-4 font-semibold text-red-500 hover:text-red-400">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500">
                        Tidak ada data karyawan yang cocok dengan filter Anda.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    {{-- Pagination --}}
    <div class="mt-6">
        {{ $karyawans->links() }}
    </div>
</div>