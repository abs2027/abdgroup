<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyProfile extends Component
{
    public function render() 
    {
        // Ambil data karyawan yang terhubung dengan user yang sedang login
        $karyawan = Auth::user()->karyawan;

        return view('livewire.my-profile', [
            'karyawan' => $karyawan,
        ])->layout('components.layouts.app'); // Gunakan layout utama
    }
}
