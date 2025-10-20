<?php

namespace App\Livewire; // Sesuaikan jika lokasi file Anda berbeda

use App\Models\JabatanPosisi;
use App\Models\Karyawan;
use App\Models\LokasiPenempatan;
use App\Models\User;
use Filament\Events\Auth\Registered;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class KaryawanIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    // [BARU] Properti untuk menampung nilai dari dropdown filter
    public $filterLokasi = '';
    public $filterJabatan = '';
    public $filterStatus = '';

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir === "ASC") ? 'DESC' : "ASC";
            return;
        }
        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function render()
    {
        $karyawans = Karyawan::search($this->search)
            ->with(['jabatanPosisi', 'lokasiPenempatan'])
            // [BARU] Terapkan filter HANYA JIKA dropdown dipilih
            ->when($this->filterLokasi, function ($query) {
                $query->where('lokasi_penempatan_id', $this->filterLokasi);
            })
            ->when($this->filterJabatan, function ($query) {
                $query->where('jabatan_posisi_id', $this->filterJabatan);
            })
            ->when($this->filterStatus, function ($query) {
                $query->where('status_karyawan', $this->filterStatus);
            })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate(10);

        return view('livewire.karyawan-index', [
            'karyawans' => $karyawans,
            // [BARU] Kirim data untuk mengisi dropdown ke view
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

        // Jangan buat akun jika sudah ada
        if ($karyawan && !$karyawan->user_id) {
            
            // Buat email sementara, contoh: asep.12123123@abdgroup.test
            $email = str_replace(' ', '.', strtolower($karyawan->nama_panjang)) . '.' . $karyawan->nomer_induk_karyawan . '@' . request()->getHost();

            // Buat user baru
            $user = User::create([
                'name' => $karyawan->nama_panjang,
                'email' => $email,
                'password' => Hash::make(now()), // Password acak sementara
            ]);

            // Hubungkan user ke karyawan
            $karyawan->user_id = $user->id;
            $karyawan->save();

            // Kirim email untuk setup password
            event(new Registered($user));
        }
    }
}