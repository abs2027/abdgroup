<x-layouts.app>
    <x-slot:title>
        Tambah Aset Baru
    </x-slot:title>

    <div class="p-6">
        <h1 class="text-2xl font-semibold mb-4 text-zinc-900 dark:text-white">Tambah Aset Baru</h1>

        <div class="bg-white dark:bg-zinc-900 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                @php
                    $categoryMap = $categories->pluck('name', 'id');
                @endphp

                <form action="{{ route('assets.store') }}" method="POST" 
                      x-data="{ selectedCategory: '', categories: {{ $categoryMap->toJson() }} }">
                    @csrf
                    
                    <div class="space-y-4">

                        <div>
                            <label for="name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Nama Aset</label>
                            <input type="text" name="name" id="name" required 
                                   class="mt-1 block w-full px-3 py-2 border border-zinc-300 rounded-md shadow-sm dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">Contoh: Excavator EX-01, Gedung Kantor A</p>
                        </div>

                        <div>
                            <label for="asset_category_id" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Jenis Aset</label>
                            <select name="asset_category_id" id="asset_category_id" required 
                                    x-model="selectedCategory" class="mt-1 block w-full px-3 py-2 border border-zinc-300 rounded-md shadow-sm dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                                <option value="">-- Pilih Jenis --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div x-show="categories[selectedCategory] === 'forklift'" x-transition class="space-y-4 p-4 border rounded-md dark:border-zinc-700">
                            <h3 class="font-medium text-lg dark:text-white">Spesifikasi Forklift</h3>
                            <div>
                                <label for="kapasitas_ton" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Kapasitas (Ton)</label>
                                <input type="number" step="0.1" name="specifications[kapasitas_ton]" id="kapasitas_ton" 
                                       class="mt-1 block w-full px-3 py-2 border border-zinc-300 rounded-md shadow-sm dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                            </div>
                            <div>
                                <label for="merk" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Merek</label>
                                <input type="text" name="specifications[merk]" id="merk" 
                                       class="mt-1 block w-full px-3 py-2 border border-zinc-300 rounded-md shadow-sm dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                            </div>
                        </div>

                        <div x-show="categories[selectedCategory] === 'Gedung'" x-transition class="space-y-4 p-4 border rounded-md dark:border-zinc-700">
                           <h3 class="font-medium text-lg dark:text-white">Spesifikasi Gedung</h3>
                           <div>
                                <label for="luas_tanah" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Luas Tanah (m2)</label>
                                <input type="number" name="specifications[luas_tanah]" id="luas_tanah" 
                                       class="mt-1 block w-full px-3 py-2 border border-zinc-300 rounded-md shadow-sm dark:bg-zinc-800 dark:border-zinc-600 dark:text-white">
                           </div>
                        </div>

                    </div> <div class="mt-6 flex justify-end">
                        <a href="{{ route('assets.index') }}" class="px-4 py-2 bg-zinc-200 text-zinc-800 rounded-md hover:bg-zinc-300 dark:bg-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-600">
                            Batal
                        </a>
                        <button type="submit" class="ml-3 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Simpan Aset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>