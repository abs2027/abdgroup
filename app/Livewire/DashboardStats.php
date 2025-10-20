<?php

namespace App\Livewire;

use App\Models\Karyawan;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DashboardStats extends Component
{
    public function render()
    {
        // Menghitung statistik dasar
        $totalKaryawan = Karyawan::count();
        $karyawanTetap = Karyawan::where('status_karyawan', 'Tetap')->count();
        $karyawanKontrak = Karyawan::where('status_karyawan', 'Kontrak')->count();
        $karyawanMagang = Karyawan::where('status_karyawan', 'Magang')->count();

        // Menghitung distribusi karyawan per lokasi
        $distribusiLokasi = Karyawan::join('lokasi_penempatans', 'karyawans.lokasi_penempatan_id', '=', 'lokasi_penempatans.id')
            ->select('lokasi_penempatans.nama_lokasi', DB::raw('count(*) as total'))
            ->groupBy('lokasi_penempatans.nama_lokasi')
            ->orderBy('total', 'desc')
            ->get();

        return view('livewire.dashboard-stats', [
            'totalKaryawan' => $totalKaryawan,
            'karyawanTetap' => $karyawanTetap,
            'karyawanKontrak' => $karyawanKontrak,
            'karyawanMagang' => $karyawanMagang,
            'distribusiLokasi' => $distribusiLokasi,
        ]);
    }
}
