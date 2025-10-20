<div>
    {{-- Pesan Sukses --}}
    @if (session()->has('message'))
        <div class="mb-4 rounded-lg bg-green-100 px-6 py-5 text-base text-green-700" role="alert">
            {{ session('message') }}
        </div>
    @endif

    {{-- Grid Layout untuk Form --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        {{-- Nomer Induk Karyawan --}}
        <div>
            <label for="nik" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nomer Induk Karyawan</label>
            <input type="text" id="nik" wire:model.defer="nomer_induk_karyawan" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
            @error('nomer_induk_karyawan') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Nama Panjang --}}
        <div>
            <label for="nama" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nama Panjang</label>
            <input type="text" id="nama" wire:model.defer="nama_panjang" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
            @error('nama_panjang') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- NIK KTP --}}
        <div>
            <label for="nik_ktp" class="block font-medium text-sm text-gray-700 dark:text-gray-300">NIK KTP</label>
            <input type="text" id="nik_ktp" wire:model.defer="nik_ktp" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
            @error('nik_ktp') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Alamat Domisili --}}
        <div>
            <label for="alamat_domisili" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Alamat Domisili</label>
            <textarea id="alamat_domisili" wire:model.defer="alamat_domisili" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
            @error('alamat_domisili') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Lokasi Penempatan --}}
        <div>
            <label for="lokasi" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Lokasi Penempatan</label>
            <select id="lokasi" wire:model.defer="lokasi_penempatan_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">-- Pilih Lokasi --</option>
                @foreach($semua_lokasi as $lokasi)
                    <option value="{{ $lokasi->id }}">{{ $lokasi->nama_lokasi }}</option>
                @endforeach
            </select>
            @error('lokasi_penempatan_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Jabatan --}}
        <div>
            <label for="jabatan" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Jabatan</label>
            <select id="jabatan" wire:model.defer="jabatan_posisi_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">-- Pilih Jabatan --</option>
                @foreach($semua_jabatan as $jabatan)
                    <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
                @endforeach
            </select>
            @error('jabatan_posisi_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Nomer HP --}}
        <div>
            <label for="hp" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nomer HP</label>
            <input type="text" id="hp" wire:model.defer="nomer_hp" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
            @error('nomer_hp') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Tanggal Masuk --}}
        <div>
            <label for="tanggal_masuk" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Tanggal Masuk</label>
            <input type="date" id="tanggal_masuk" wire:model.defer="tanggal_masuk" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
            @error('tanggal_masuk') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        
        {{-- Status Karyawan --}}
        <div>
            <label for="status_karyawan" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Status Karyawan</label>
            <select id="status_karyawan" wire:model.defer="status_karyawan" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">-- Pilih Status --</option>
                <option value="Tetap">Tetap</option>
                <option value="Kontrak">Kontrak</option>
                <option value="Magang">Magang</option>
            </select>
            @error('status_karyawan') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
    </div>

    <hr class="my-6 border-gray-200 dark:border-gray-700">

    <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight mb-4">Informasi Kontak Darurat</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Nama Kontak Darurat --}}
        <div>
            <label for="nama_kontak_darurat" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nama Kontak Darurat</label>
            <input type="text" id="nama_kontak_darurat" wire:model.defer="nama_kontak_darurat" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
            @error('nama_kontak_darurat') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- HP Kontak Darurat --}}
        <div>
            <label for="hp_kontak_darurat" class="block font-medium text-sm text-gray-700 dark:text-gray-300">HP Kontak Darurat</label>
            <input type="text" id="hp_kontak_darurat" wire:model.defer="hp_kontak_darurat" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
            @error('hp_kontak_darurat') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
    </div>
    
    {{-- Tombol Aksi --}}
    <div class="flex items-center justify-end mt-6">
        <button wire:click="saveKaryawan" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
            Simpan Data
        </button>
    </div>

</div>