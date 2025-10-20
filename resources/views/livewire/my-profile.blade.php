<div>
    {{-- Konten Utama Halaman --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            {{-- Pastikan ada data karyawan sebelum menampilkan --}}
            @if ($karyawan)
                {{-- Panel Informasi Karyawan --}}
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Informasi Profil</h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Data personalia Anda yang tercatat di sistem.
                        </p>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="px-4 py-5 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Lengkap</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $karyawan->nama_panjang }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nomer Induk Karyawan</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $karyawan->nomer_induk_karyawan }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Jabatan</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $karyawan->jabatanPosisi->nama_jabatan ?? 'N/A' }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Lokasi Penempatan</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $karyawan->lokasiPenempatan->nama_lokasi ?? 'N/A' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>

                {{-- Panel Dokumen Tersimpan --}}
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Dokumen Saya</h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Lihat atau unduh dokumen pribadi Anda.
                        </p>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($karyawan->dokumens as $dokumen)
                                    <li class="px-6 py-4 flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-200">{{ $dokumen->nama_dokumen }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $dokumen->nama_asli_file }}</p>
                                        </div>
                                        <a href="{{ Storage::url($dokumen->path_file) }}" target="_blank" class="font-semibold text-indigo-400 hover:text-indigo-300 text-sm">Lihat</a>
                                    </li>
                                @empty
                                    <li class="px-6 py-4 text-sm text-center text-gray-500 dark:text-gray-400">
                                        Belum ada dokumen yang diunggah.
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            @else
                {{-- Tampilan jika user yang login bukan seorang karyawan --}}
                <div class="text-center text-gray-500 dark:text-gray-400">
                    <p>Profil karyawan tidak ditemukan.</p>
                </div>
            @endif
        </div>
    </div>
</div>