<div>
    <form wire:submit.prevent="update">
        {{-- Panel Informasi Karyawan --}}
        <div class="md:grid md:grid-cols-3 md:gap-6">
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
                        
                        {{-- Nama Panjang --}}
                        <div class="col-span-6 sm:col-span-3">
                            <label for="nama_panjang" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nama Panjang</label>
                            <input type="text" wire:model.defer="nama_panjang" id="nama_panjang" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                            @error('nama_panjang') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- Nomer Induk Karyawan --}}
                        <div class="col-span-6 sm:col-span-3">
                            <label for="nik" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nomer Induk Karyawan</label>
                            <input type="text" wire:model.defer="nomer_induk_karyawan" id="nik" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                            @error('nomer_induk_karyawan') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- NIK KTP --}}
                        <div class="col-span-6 sm:col-span-3">
                            <label for="nik_ktp" class="block font-medium text-sm text-gray-700 dark:text-gray-300">NIK KTP</label>
                            <input type="text" wire:model.defer="nik_ktp" id="nik_ktp" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                            @error('nik_ktp') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                         {{-- Alamat Domisili --}}
                        <div class="col-span-6 sm:col-span-3">
                            <label for="alamat_domisili" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Alamat Domisili</label>
                            <textarea wire:model.defer="alamat_domisili" id="alamat_domisili" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"></textarea>
                            @error('alamat_domisili') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- Lokasi Penempatan --}}
                        <div class="col-span-6 sm:col-span-3">
                             <label for="lokasi" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Lokasi Penempatan</label>
                            <select wire:model.defer="lokasi_penempatan_id" id="lokasi" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                @foreach($semua_lokasi as $lokasi)
                                    <option value="{{ $lokasi->id }}">{{ $lokasi->nama_lokasi }}</option>
                                @endforeach
                            </select>
                            @error('lokasi_penempatan_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- Jabatan --}}
                        <div class="col-span-6 sm:col-span-3">
                             <label for="jabatan" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Jabatan</label>
                            <select wire:model.defer="jabatan_posisi_id" id="jabatan" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                @foreach($semua_jabatan as $jabatan)
                                    <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
                                @endforeach
                            </select>
                            @error('jabatan_posisi_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                         {{-- Nomer HP --}}
                        <div class="col-span-6 sm:col-span-3">
                            <label for="hp" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nomer HP</label>
                            <input type="text" wire:model.defer="nomer_hp" id="hp" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                            @error('nomer_hp') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- Tanggal Masuk --}}
                        <div class="col-span-6 sm:col-span-3">
                            <label for="tanggal_masuk" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Tanggal Masuk</label>
                            <input type="date" wire:model.defer="tanggal_masuk" id="tanggal_masuk" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                            @error('tanggal_masuk') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- Status Karyawan --}}
                        <div class="col-span-6 sm:col-span-3">
                            <label for="status_karyawan" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Status Karyawan</label>
                            <select wire:model.defer="status_karyawan" id="status_karyawan" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                <option value="Tetap">Tetap</option>
                                <option value="Kontrak">Kontrak</option>
                                <option value="Magang">Magang</option>
                            </select>
                            @error('status_karyawan') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        {{-- Panel Kontak Darurat (terpisah untuk kerapian) --}}
        <div class="mt-8 md:grid md:grid-cols-3 md:gap-6">
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
                        <div class="col-span-6 sm:col-span-3">
                            <label for="nama_kontak_darurat" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nama Kontak Darurat</label>
                            <input type="text" wire:model.defer="nama_kontak_darurat" id="nama_kontak_darurat" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                            @error('nama_kontak_darurat') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="hp_kontak_darurat" class="block font-medium text-sm text-gray-700 dark:text-gray-300">HP Kontak Darurat</label>
                            <input type="text" wire:model.defer="hp_kontak_darurat" id="hp_kontak_darurat" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                            @error('hp_kontak_darurat') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tombol Aksi --}}
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
</div>