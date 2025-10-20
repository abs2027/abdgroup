<div>
    {{-- Form utama untuk update data karyawan --}}
    <form wire:submit.prevent="update">
        {{-- Panel Informasi Karyawan --}}
        <div class="md:grid md:grid-cols-3 md:gap-6">
            {{-- ... (kode panel informasi karyawan Anda tetap sama) ... --}}
            <div class="md:col-span-1 flex justify-between">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Informasi Karyawan</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Perbarui data profil dan informasi kepegawaian karyawan.
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="px-4 py-5 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="grid grid-cols-6 gap-6">
                        {{-- Semua field form karyawan ada di sini --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Panel Kontak Darurat --}}
        <div class="mt-8 md:grid md:grid-cols-3 md:gap-6">
            {{-- ... (kode panel kontak darurat Anda tetap sama) ... --}}
            <div class="md:col-span-1 flex justify-between">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Kontak Darurat</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Informasi kontak yang dapat dihubungi saat keadaan darurat.
                    </p>
                </div>
            </div>
             <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="px-4 py-5 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                     <div class="grid grid-cols-6 gap-6">
                        {{-- Field form kontak darurat ada di sini --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Tombol Aksi untuk form utama --}}
        <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6 mt-6">
            @if (session()->has('message'))
                <span class="mr-3 text-sm text-green-600 dark:text-green-400">
                    {{ session('message') }}
                </span>
            @endif
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                Simpan Perubahan
            </button>
        </div>
    </form>

    {{-- [BARU] Panel untuk Manajemen Dokumen --}}
    <hr class="my-8 border-gray-700">

    <div class="mt-8 md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1 flex justify-between">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Manajemen Dokumen</h3>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Unggah atau kelola file dokumen yang terhubung dengan karyawan ini.
                </p>
            </div>
        </div>

        <div class="mt-5 md:mt-0 md:col-span-2">
            {{-- Form untuk upload dokumen BARU --}}
            <form wire:submit.prevent="uploadDokumen">
                <div class="px-4 py-5 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    @if (session()->has('message-dokumen'))
                        <div class="mb-4 rounded-lg bg-green-100 px-6 py-5 text-base text-green-700" role="alert">
                            {{ session('message-dokumen') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="nama_dokumen_baru" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nama Dokumen</label>
                            <input type="text" wire:model="nama_dokumen_baru" id="nama_dokumen_baru" placeholder="Contoh: KTP, Ijazah S1" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                            @error('nama_dokumen_baru') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="file_dokumen_baru" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Pilih File</label>
                            <input type="file" wire:model="file_dokumen_baru" id="file_dokumen_baru" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600">
                            @error('file_dokumen_baru') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                    {{-- Indikator Loading --}}
                    <div wire:loading wire:target="file_dokumen_baru" class="mt-2 text-sm text-gray-400">
                        Mengunggah file...
                    </div>

                    <div class="flex justify-end mt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                            Unggah
                        </button>
                    </div>
                </div>
            </form>

            {{-- Daftar dokumen yang SUDAH di-upload --}}
            <div class="mt-6 px-4 py-5 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h4 class="text-md font-medium text-gray-900 dark:text-white mb-4">Dokumen Tersimpan</h4>
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($karyawan->dokumens as $dokumen)
                        <li class="py-3 flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-gray-200">{{ $dokumen->nama_dokumen }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $dokumen->nama_asli_file }}</p>
                            </div>
                            <div class="flex items-center gap-x-4">
                                <a href="{{ Storage::url($dokumen->path_file) }}" target="_blank" class="font-semibold text-indigo-400 hover:text-indigo-300 text-sm">Lihat</a>
                                
                                {{-- Tombol Hapus Baru --}}
                                <button
                                    type="button"
                                    wire:click="deleteDokumen({{ $dokumen->id }})"
                                    wire:confirm="Anda yakin ingin menghapus dokumen ini selamanya?"
                                    class="font-semibold text-red-500 hover:text-red-400 text-sm">
                                    Hapus
                                </button>
                            </div>
                        </li>
                    @empty
                        <li class="py-3 text-sm text-center text-gray-500 dark:text-gray-400">
                            Belum ada dokumen yang diunggah.
                        </li>
                    @endforelse
                </ul>
            </div>

        </div>
    </div>
</div>