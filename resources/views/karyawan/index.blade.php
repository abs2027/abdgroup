<x-layouts.app>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Panel Utama Bergaya Filament --}}
            <div class="bg-white dark:bg-gray-800/50 dark:ring-1 dark:ring-white/10 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8">
                    {{-- Bagian Header Panel --}}
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                        <div>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-white">
                                Daftar Karyawan
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                Kelola semua data karyawan di perusahaan Anda.
                            </p>
                        </div>
                        <a href="{{ route('karyawan.create') }}" wire:navigate class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                            Tambah Karyawan Baru
                        </a>
                    </div>
                    
                    {{-- Komponen Livewire dipanggil di sini, di dalam panel --}}
                    @livewire('karyawan-index')
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>