<?php

namespace App\Livewire;

use App\Models\Karyawan;
use Livewire\Component;

class KaryawanIndex extends Component
{
    public function render()
    {
        // Gunakan 'with()' untuk mengambil relasi 'jabatanPosisi'
        $karyawans = Karyawan::with('jabatanPosisi')->latest()->paginate(10); 
        
        return view('livewire.karyawan-index', [
            'karyawans' => $karyawans
        ]);
    }

    // TAMBAHKAN FUNGSI INI
    public function deleteKaryawan($id)
    {
        $karyawan = Karyawan::find($id);
        if ($karyawan) {
            $karyawan->delete();
        }
    }
}
