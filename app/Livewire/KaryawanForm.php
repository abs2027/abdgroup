<?php

namespace App\Livewire;

use App\Models\JabatanPosisi;
use App\Models\LokasiPenempatan;
use Livewire\Component;

class KaryawanForm extends Component
{
    public $nomer_induk_karyawan;
    public $nama_panjang;
    public $nik_ktp;
    public $alamat_domisili;
    public $lokasi_penempatan_id;
    public $jabatan_posisi_id;
    public $nomer_hp;
    public $tanggal_masuk;
    public $status_karyawan;
    public $nama_kontak_darurat;
    public $hp_kontak_darurat;

    protected $rules = [
        'nomer_induk_karyawan' => 'required|unique:karyawans,nomer_induk_karyawan',
        'nama_panjang'           => 'required|string|min:3',
        'nik_ktp'                => 'required|digits:16|unique:karyawans,nik_ktp',
        'alamat_domisili'        => 'required|string|min:10',
        'lokasi_penempatan_id'   => 'required|exists:lokasi_penempatans,id',
        'jabatan_posisi_id'      => 'required|exists:jabatan_posisis,id',
        'nomer_hp'               => 'required|numeric|min:10',
        'tanggal_masuk'          => 'required|date',
        'status_karyawan'        => 'required',
        'nama_kontak_darurat'    => 'required|string|min:3',
        'hp_kontak_darurat'      => 'required|numeric|min:10',
    ];

    protected $fillable = [
        'nomer_induk_karyawan',
        'nama_panjang',
        'nik_ktp',
        'alamat_domisili',
        'lokasi_penempatan_id',
        'jabatan_posisi_id',
        'nomer_hp',
        'tanggal_masuk',
        'status_karyawan',
        'nama_kontak_darurat',
        'hp_kontak_darurat',
    ];
    
    public function render()
    {
        // Mengambil semua data dari model untuk dropdown
        $semua_lokasi = LokasiPenempatan::all();
        $semua_jabatan = JabatanPosisi::all();

        return view('livewire.karyawan-form', [
            'semua_lokasi' => $semua_lokasi,
            'semua_jabatan' => $semua_jabatan,
        ]);
    }

    // Ubah method saveKaryawan() yang kosong
    public function saveKaryawan()
    {
        // 1. Jalankan validasi berdasarkan $rules yang sudah kita definisikan
        $validatedData = $this->validate();

        // 2. Jika validasi berhasil, buat record baru di database
        \App\Models\Karyawan::create($validatedData);

        // 3. Buat pesan flash untuk notifikasi sukses
        session()->flash('message', 'Data karyawan berhasil disimpan.');

        // 4. Kosongkan kembali semua field form setelah berhasil disimpan
        $this->reset();
    }
}
