<x-layouts.app>
    {{-- Kita tidak menggunakan <x-slot name="header"> agar lebih luas --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Tugas file ini HANYA memanggil komponen 'perabotan' kita --}}
            @livewire('dashboard-stats')
        </div>
    </div>
</x-layouts.app>