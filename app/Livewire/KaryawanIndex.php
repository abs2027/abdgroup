<?php

namespace App\Livewire; // Sesuaikan jika lokasi file Anda berbeda

use App\Models\JabatanPosisi;
use App\Models\Karyawan;
use App\Models\LokasiPenempatan;
use App\Models\User;
use Illuminate\Auth\Events\Registered; // <-- [PERBAIKAN] Menggunakan event bawaan Laravel
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class KaryawanIndex extends Component
{
    use WithPagination;

    // Properti untuk filter & sorting
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';
    public $filterLokasi = '';
    public $filterJabatan = '';
    public $filterStatus = '';

    // [BARU] Properti untuk Aksi Massal
    public $selectedKaryawans = [];
    public $selectAll = false;

    // [BARU] Dijalankan saat checkbox "select all" di-klik
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedKaryawans = $this->getKaryawansQuery()->pluck('id')->map(fn ($id) => (string) $id);
        } else {
            $this->selectedKaryawans = [];
        }
    }

    // [BARU] Fungsi untuk menghapus semua data yang dipilih
    public function deleteSelected()
    {
        Karyawan::whereIn('id', $this->selectedKaryawans)->delete();
        $this->reset(['selectedKaryawans', 'selectAll']);
    }
    
    // Hook untuk mereset halaman saat filter/pencarian berubah
    public function updatingSearch() { $this->resetPage(); }
    public function updatingFilterLokasi() { $this->resetPage(); }
    public function updatingFilterJabatan() { $this->resetPage(); }
    public function updatingFilterStatus() { $this->resetPage(); }

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir === "ASC") ? 'DESC' : "ASC";
            return;
        }
        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    // Helper function untuk query utama agar tidak duplikat
    public function getKaryawansQuery()
    {
        return Karyawan::search($this->search)
            ->when($this->filterLokasi, fn ($query) => $query->where('lokasi_penempatan_id', $this->filterLokasi))
            ->when($this->filterJabatan, fn ($query) => $query->where('jabatan_posisi_id', $this->filterJabatan))
            ->when($this->filterStatus, fn ($query) => $query->where('status_karyawan', $this->filterStatus))
            ->orderBy($this->sortBy, $this->sortDir);
    }

    public function render()
    {
        return view('livewire.karyawan-index', [
            'karyawans' => $this->getKaryawansQuery()->paginate(10),
            'semua_lokasi' => LokasiPenempatan::all(),
            'semua_jabatan' => JabatanPosisi::all(),
        ]);
    }

    public function deleteKaryawan($id)
    {
        $karyawan = Karyawan::find($id);
        if ($karyawan) {
            $karyawan->delete();
        }
    }

    public function buatAkunLogin($karyawanId)
    {
        $karyawan = Karyawan::find($karyawanId);
        if ($karyawan && !$karyawan->user_id) {
            $email = str_replace(' ', '.', strtolower($karyawan->nama_panjang)) . '.' . $karyawan->nomer_induk_karyawan . '@' . request()->getHost();
            $user = User::create([
                'name' => $karyawan->nama_panjang,
                'email' => $email,
                'password' => Hash::make(now()),
            ]);
            $karyawan->user_id = $user->id;
            $karyawan->save();
            event(new Registered($user));
        }
    }
}