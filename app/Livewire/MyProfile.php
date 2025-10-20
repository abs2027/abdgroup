<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

class MyProfile extends Component
{
    public $karyawan;
    public function mount()
    {
        // Ambil data dan simpan ke public property
        $this->karyawan = Auth::user()->karyawan;
    }

    public function render() 
    {
       return view('livewire.my-profile');
    }
}
