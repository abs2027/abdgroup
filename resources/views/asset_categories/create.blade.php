<x-layouts.app>
    <x-slot:title>
        Tambah Jenis Aset
    </x-slot:title>

    <div class="p-6">
        <h1 class="text-2xl font-semibold mb-4 text-zinc-900 dark:text-white">Tambah Jenis Aset Baru</h1>

        <div class="bg-white dark:bg-zinc-900 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-md dark:bg-red-900 dark:text-red-200">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            
                <form action="{{ route('asset_categories.store') }}" method="POST">
                    @csrf
                    
                    <div>
                        <label for="name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Nama Jenis Aset</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required 
                               class="mt-1 block w-full px-3 py-2 border border-zinc-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-800 dark:border-zinc-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 sm:text-sm">
                        <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">Contoh: Alat Berat, Bangunan, Kendaraan, Komputer</p>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('asset_categories.index') }}" class="px-4 py-2 bg-zinc-200 text-zinc-800 rounded-md hover:bg-zinc-300 dark:bg-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-600">
                            Batal
                        </a>
                        <button type="submit" class="ml-3 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>